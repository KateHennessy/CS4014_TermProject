<?php
    require_once __DIR__.'/templates/header.template.php';
    require_once __DIR__.'/models/User.class.php';
    require_once __DIR__.'/models/Tag.class.php';
    ?>

    <!-- Main PAGE -->
    <div class="container-fluid">
        <div class="col-xs-11 col-sm-8 well">
            <div class="row">
                <h1><div class="glyphicon glyphicon-lock"></div> Forgotten Password </h1><br>
                <div class="col-xs-10">
                  <p> We'll send a new password to your email address </p>
                    <form>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Email Address</label>
                                <div><input type="email" onblur="validateEmail()" id="contactEmail" placeholder="Enter Email Address Here.." class="form-control"></div>
                            </div>
						</div>
                    <button type="button" class="btn btn-lg btn-success">Send me a new Password</button>
                </form>
				</div>
                </div>
            </div>
        </div>
    <script>
        // FUNCTION TO PROVIDE AUTO COMPLETE FOR TAGS
        $('[id^=tag]').typeahead({ //[id^=tag] -- anything starting with 'tag'
            // $('tag1').typeahead({
            local: ['Performing Arts', 'Visual Arts', 'Geography', 'History', 'Languages',
                'Literature', 'Philosophy', 'Economics', 'Law', 'Political Science', 'Psychology',
                'Sociology', 'Biology', 'Chemistry', 'Earth and Space Sciences', 'Mathematics',
                'Physics', 'Agricultural Sciences', 'Computer Science', 'Engineering and Technology',
                'Medicine and Health Sciences'
            ]
        });

        $('.tt-query').css('background-color', '#fff');


        function validateEmail() {
            id = "contactEmail";
            // var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
            var email_regex = /^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(ul)\.ie$/g; //ul.ie domain
            if (!email_regex.test($("#" + id).val())) {

                var div = $("#" + id).closest("div");
                div.removeClass("has-success");
                $("#glypcn" + id).remove();
                div.addClass("has-error has-feedback");
                div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
                return false;
            } else {
                var div = $("#" + id).closest("div");
                div.removeClass("has-error");
                $("#glypcn" + id).remove();
                div.addClass("has-success has-feedback");
                div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
                return true;
            }

        }
    </script>

</body>

</html>
