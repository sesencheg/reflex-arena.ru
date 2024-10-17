    <div id="footer">
    	<p><a href="https://www.donationalerts.com/r/ql_quake_tv" target="_blank">Donate</a></p>
    </div>
</div>
<script language="javascript" type="text/javascript">
	jQuery.fn.placeholder = function() {
		var value = this.val();

		$(this).focus(function() {
			if (this.value == value)
				this.value = "";
		});

		$(this).blur(function() {
			if (this.value == "")
				this.value = value;
		});
	};

	$('#ctl00_txtPlayerSearch').placeholder();
</script>
    
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter43402834 = new Ya.Metrika({
                    id:43402834,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/43402834" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->