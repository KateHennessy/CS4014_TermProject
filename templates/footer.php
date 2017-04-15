  <div class="footer">
    <!-- Brand and toggle get grouped for better mobile display -->

      <a class="col-xs-2 text-muted" href="index.php"><div class="glyphicon glyphicon-home"></div>RevIUL </a>
      <a class="col-xs-2 text-muted" href="aboutus.php"><div class="glyphicon glyphicon-user"></div>About Us</a>
      <a class="col-xs-2 text-muted " href="information.php"><div class="glyphicon glyphicon-info-sign"></div>FAQ</a>
      <a class="col-xs-2 text-muted " href="contactus.php"><div class="glyphicon glyphicon-send"></div>Contact Us</a>
        <p class="pull-right">  © Copyright 2017 </p>

    </div>

    <script>



    // Window load event used just in case window height is dependant upon images
    //Some code taken from stackoverflow below as text fields in form were overlappiing on the footer http://stackoverflow.com/questions/33735000/webpage-doesnt-adjust-to-any-screen-height-automatically
    $(window).bind("load", function() {

     var footerHeight = 0,
         footerTop = 0,
         $footer = $("#footer");

     positionFooter();

     function positionFooter() {

              footerHeight = $footer.height();
              footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";

             if ( ($(document.body).height()+footerHeight) < $(window).height()) {
                 $footer.css({
                      position: "absolute"
                 }).animate({
                      top: footerTop
                 })
             } else {
                 $footer.css({
                      position: "static"
                 })
             }

     }

     $(window)
             .scroll(positionFooter)
             .resize(positionFooter)

});

    </script>
