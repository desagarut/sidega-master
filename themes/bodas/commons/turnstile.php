  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" defer></script>
  <div id="my-widget"></div>

  <script>
      window.onload = function() {
          turnstile.render('#my-widget', {
              sitekey: '<YOUR-SITE-KEY>',
              theme: 'light',
              callback: function(token) {
                  console.log('Success:', token);
              }
          });
      };
  </script>