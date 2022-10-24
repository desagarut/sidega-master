"use strict";
// =========================================================
// ==================    ui kit model code   ===============
// =========================================================
(function() {
    function hasClass(el, cls) {
        return el.className.split(' ').indexOf(cls) !== -1;
    }

    function dattacodbnd(source, blacklist) {
        source = source
            .replace(/\r/g, '')
            .replace(/\t/g, '  ')
            .replace(/^ *\n+/, '\n')
            .replace(/[\s\n]+$/, '');

        source = source.replace(new RegExp('\\n' + source.match(/^\n( *)/)[1], 'g'), '\n');

        if (blacklist) {
            source = source.replace(/class="([^"]+)"/g, function(m, clsStr) {
                var clsArr = clsStr.replace(/^\s+|\s+$/, '').replace(/\s+/g, ' ').split(' ');

                for (var i = 0, l = blacklist.length, clsInd; i < l; i++) {
                    if ((clsInd = clsArr.indexOf(blacklist[i])) !== -1) {
                        clsArr.splice(clsInd, 1);
                    }
                }

                return 'class="' + clsArr.join(' ') + '"';
            });
        }

        return source
            .replace(/\s+class=""/ig, '')
            .replace(/([a-z]+)=""/ig, '$1')
            .replace(/javascript:void\(0\)/g, '#')
            .replace(/^\n/, '');
    }

    function Dattaclp(el, src) {
        return new ClipboardJS(el, {
            text: function() {
                return src;
            }
        });
    }

    function Dattaopnmdl(src, formattedSrc) {
        document.querySelector('.datta-example-modal-content').innerHTML = '<pre><code class="hljs html xml">' + formattedSrc + '</code></pre>';

        var btn_copy = document.querySelector('.md-datta-example-modal-copy');
        var closeBtn = document.querySelector('.datta-example-modal-close');

        var btn_copyTimeout = null;
        var ClipboardJS = Dattaclp(btn_copy, src);

        ClipboardJS.on('success', function(e) {
            if (btn_copyTimeout) {
                clearTimeout(btn_copyTimeout);
                btn_copyTimeout = null;
            }

            btn_copy.className = btn_copy.className.replace(' copied', '');
            btn_copy.className += ' copied';

            btn_copyTimeout = setTimeout(function() {
                btn_copy.className = btn_copy.className.replace(' copied', '');
            }, 1000);
        });

        var closeListener = function() {
            document.querySelector('.datta-example-modal-content').innerHTML = '';
            document.querySelector('.datta-example-modal').scrollTop = 0;
            closeBtn.removeEventListener('click', closeListener);
            ClipboardJS.destroy();
            document.documentElement.className = document.documentElement.className.replace(' datta-example-modal-opened', '');
        };
        closeBtn.addEventListener('click', closeListener);
        document.documentElement.className += ' datta-example-modal-opened';
    }
    Array.prototype.slice.call(document.querySelectorAll('.datta-example')).forEach(function(parentEl) {
        var btnsWrapper = document.createElement('div');
        btnsWrapper.className = 'datta-example-btns';

        var btn_copy = document.createElement('a');
        btn_copy.href = 'javascript:void(0)';
        btn_copy.className = 'datta-example-btn copy';

        var btn_md_open = document.createElement('a');
        btn_md_open.href = 'javascript:void(0)';
        btn_md_open.className = 'datta-example-btn';
        btn_md_open.innerHTML = 'SOURCE'

        btnsWrapper.appendChild(btn_copy);
        btnsWrapper.appendChild(btn_md_open);

        var blacklistStr = (parentEl.getAttribute('data-blacklist') || null);
        var blacklist = (blacklistStr && blacklistStr.split(',')) || null;
        var src = dattacodbnd(parentEl.innerHTML, blacklist);
        var formattedSrc = hljs.highlight('html', src).value;

        parentEl.appendChild(btnsWrapper);

        var btn_copyTimeout = null;
        Dattaclp(btn_copy, src).on('success', function(e) {
            if (btn_copyTimeout) {
                clearTimeout(btn_copyTimeout);
                btn_copyTimeout = null;
            }
            btn_copy.className = btn_copy.className.replace(' copied', '');
            btn_copy.className += ' copied';

            btn_copyTimeout = setTimeout(function() {
                btn_copy.className = btn_copy.className.replace(' copied', '');
            }, 1000);
        });
        btn_md_open.addEventListener('click', function(e) {
            Dattaopnmdl(src, formattedSrc);
        });
    });
})();
