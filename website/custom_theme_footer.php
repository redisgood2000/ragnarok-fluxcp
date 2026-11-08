<?php if (!defined('FLUX_ROOT')) exit; ?>
</main>
<div class="ro-floating-language" aria-label="Language selection">
  <select id="ro-language-select" onchange="updatePreferredLanguage(this)" aria-label="Select language">
    <?php foreach(Flux::getAvailableLanguages() as $lang_key=>$lang): ?>
      <option value="<?php echo htmlspecialchars($lang_key) ?>"<?php if(!empty($_COOKIE['language']) && $_COOKIE['language']==$lang_key) echo ' selected="selected"' ?>><?php echo htmlspecialchars($lang) ?></option>
    <?php endforeach ?>
  </select>
</div>
<form action="<?php echo $this->urlWithQs ?>" method="post" name="preferred_theme_form" hidden><input type="hidden" name="preferred_theme" value=""></form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><script>
(function(){var b=document.getElementById('ro-menu-toggle'),n=document.getElementById('ro-main-nav');if(b&&n)b.addEventListener('click',function(){var o=n.classList.toggle('is-open');b.setAttribute('aria-expanded',o?'true':'false')});
document.querySelectorAll('.ro-nav-group>summary').forEach(function(s){s.addEventListener('click',function(e){if(matchMedia('(min-width:900px)').matches){e.preventDefault();var p=s.parentElement;document.querySelectorAll('.ro-nav-group[open]').forEach(function(x){if(x!==p)x.removeAttribute('open')});p.toggleAttribute('open')}})});
document.addEventListener('click',function(e){if(!e.target.closest('.ro-nav-group'))document.querySelectorAll('.ro-nav-group[open]').forEach(function(x){x.removeAttribute('open')})})})();
function updatePreferredLanguage(s){setCookie('language',s.value);reload()}function updatePreferredTheme(s){document.preferred_theme_form.preferred_theme.value=s.value;document.preferred_theme_form.submit()}
function setCookie(k,v){var d=new Date();d.setTime(d.getTime()+31536000000);document.cookie=k+'='+encodeURIComponent(v)+';expires='+d.toUTCString()+';path=/;SameSite=Lax'}
function reload(){location.href='<?php echo $this->url ?>'}function toggleSearchForm(){if(window.jQuery)jQuery('.search-form').slideToggle('fast')}
function refreshSecurityCode(sel){var i=document.querySelector(sel);if(i)i.src='<?php echo $this->url('captcha') ?>'+(<?php echo Flux::config('UseCleanUrls')?'true':'false' ?>?'?nocache=':'&nocache=')+Math.random()}
if(window.jQuery)jQuery(function($){$('.money-input').on('keyup',function(){var n=parseInt($(this).val()/<?php echo Flux::config('CreditExchangeRate') ?>,10);$('.credit-input').val(isNaN(n)?'?':n)}).trigger('keyup');$('.credit-input').on('keyup',function(){var n=parseFloat($(this).val()*<?php echo Flux::config('CreditExchangeRate') ?>);$('.money-input').val(isNaN(n)?'?':n.toFixed(2))}).trigger('keyup')});
</script><?php if(Flux::config('EnableReCaptcha') && Flux::config('ReCaptchaTheme')): ?><script>var RecaptchaOptions={theme:'<?php echo Flux::config('ReCaptchaTheme') ?>'};</script><?php endif ?>
</body></html>