<x-guest-layout>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 90vh; background: #f2f2f2;">
        <div style="display: flex; flex-direction: row; align-items: center; background: none; box-shadow: none; border-radius: 0; padding: 0;">
            <!-- Form Section -->
            <div style="padding: 0 32px; min-width: 400px; display: flex; flex-direction: column; align-items: center;">
                <a href="/">
                    <img src="/images/logoipsum-265.svg" alt="Logo" style="height: 48px; margin-bottom: 8px;">
                </a>
                <h2 style="font-size: 2.2rem; font-weight: bold; color: #444; margin-bottom: 18px; margin-top: 8px;">Request Password Reset</h2>
                <form method="POST" action="{{ route('password.email') }}" style="width: 100%; max-width: 400px;" id="forgotFormBasic">
                    @csrf
                    <input id="email" class="block w-full mb-3 p-3 rounded border border-gray-300 bg-[#fffbe6] focus:outline-none focus:border-orange-400" type="email" name="email" :value="old('email')" required autofocus placeholder="Your Email" />
                    <button type="submit" style="width: 100%; background: #ea6500; color: #fff; font-size: 1.2rem; border: none; border-radius: 30px; padding: 12px 0; margin-bottom: 16px; margin-top: 8px; cursor: pointer; font-weight: 500;">Request password reset</button>
                    <!-- Divider -->
                    <div style="display:flex; align-items:center; gap:8px; margin:12px 0;">
                        <hr style="flex:1; border-color:#e5e7eb;"/>
                        <span style="color:#666; font-size:.95rem;">or reset via SMS</span>
                        <hr style="flex:1; border-color:#e5e7eb;"/>
                    </div>
                    <!-- OTP via SMS -->
                    <input id="fp-phone" type="text" placeholder="Phone number (e.g. +2376xxxxxxx)" class="block w-full mb-2 p-3 rounded border border-gray-300 bg-white focus:outline-none focus:border-orange-400" />
                    <div style="display:flex; gap:8px; align-items:center; margin: 8px 0;">
                        <button type="button" id="fp-send-otp" style="flex:1; background:#fff; border:1px solid #ddd; border-radius:8px; padding:10px; cursor:pointer;">Send Code</button>
                        <input id="fp-code" type="text" placeholder="6-digit code" inputmode="numeric" pattern="[0-9]*" style="flex:1; padding:10px; border-radius:6px; border:1px solid #ddd; background:#fffbe6;"/>
                        <button type="button" id="fp-reset-otp" style="flex:1; background:#ea6500; color:#fff; border:none; border-radius:8px; padding:10px; cursor:pointer;">Reset via OTP</button>
                    </div>
                    <div id="fp-feedback" style="min-height:22px; font-size:.95rem; color:#666; margin-bottom:8px;"></div>
                </form>
                <div style="margin-top: 8px; color: #444; text-align: center; font-size: 1rem;">
                    Already have an account? - <a href="{{ route('login') }}" style="color: #ea6500; text-decoration: none;">Click here to login</a>
                </div>
            </div>
            <!-- Car Image Section -->
            <div style="padding: 0 40px;">
                <img src="/images/car-png-39071.png" alt="Car" style="max-width: 400px; width: 100%; height: auto;">
            </div>
        </div>
    </div>
</x-guest-layout>
<script>
(function(){
  const form = document.getElementById('forgotFormBasic');
  const phoneEl = document.getElementById('fp-phone');
  const codeEl = document.getElementById('fp-code');
  const sendBtn = document.getElementById('fp-send-otp');
  const resetBtn = document.getElementById('fp-reset-otp');
  const feedback = document.getElementById('fp-feedback');
  if (!form) return;
  const csrf = form.querySelector('input[name="_token"]').value;
  function isE164(v){ return /^\+[1-9]\d{7,14}$/.test(v); }
  async function postJson(url, data){
    const res = await fetch(url, { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf,'Accept':'application/json'}, body: JSON.stringify(data)});
    const json = await res.json().catch(()=>({}));
    if(!res.ok) throw new Error(json.message || 'Request failed');
    return json;
  }
  if (sendBtn) sendBtn.addEventListener('click', async ()=>{
    feedback.textContent='';
    const phone = phoneEl.value.trim();
    if (!isE164(phone)) { feedback.style.color='#c00'; feedback.textContent='Veuillez saisir un numéro au format E.164 (ex: +237657XXXXXX).'; return; }
    sendBtn.disabled = true; sendBtn.textContent='Sending...';
    try { await postJson('/auth/otp/reset/send', { phone }); feedback.style.color='#090'; feedback.textContent='Code envoyé par SMS. Il expire dans 5 minutes.'; }
    catch(e){ feedback.style.color='#c00'; feedback.textContent=e.message; }
    finally { sendBtn.disabled=false; sendBtn.textContent='Send Code'; }
  });
  if (resetBtn) resetBtn.addEventListener('click', async ()=>{
    feedback.textContent='';
    const phone = phoneEl.value.trim();
    const code = codeEl.value.trim();
    if (!isE164(phone)) { feedback.style.color='#c00'; feedback.textContent='Veuillez saisir un numéro au format E.164 (ex: +237657XXXXXX).'; return; }
    if (!/^\d{6}$/.test(code)) { feedback.style.color='#c00'; feedback.textContent='Entrez un code à 6 chiffres.'; return; }
    resetBtn.disabled = true; resetBtn.textContent='Processing...';
    try { await postJson('/auth/otp/reset/confirm', { phone, code }); feedback.style.color='#090'; feedback.textContent='Mot de passe temporaire envoyé par SMS. Connectez-vous puis changez-le.'; }
    catch(e){ feedback.style.color='#c00'; feedback.textContent=e.message; }
    finally { resetBtn.disabled=false; resetBtn.textContent='Reset via OTP'; }
  });
})();
</script>
