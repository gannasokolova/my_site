<a href="#top" class="pull-right to_top hide">
    <i class="glyphicon glyphicon-menu-up"></i>  </a>



</div>
<script>
    $(document).ready(function(){
        $("a[href='#top']").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    });
    $(window).scroll(function() {
        if($(document).scrollTop() > 200) { //use `this`, not `document`
            $("a[href='#top']").removeClass('hide');
        }
        if($(document).scrollTop() < 200) { //use `this`, not `document`
            $("a[href='#top']").addClass('hide');
        }
    });
</script>
<!--
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{asset ('css/js/bootstrap.js')}}"></script>
-->
</body>
</html>