<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>HTML Form + Google reCAPTCHA</title>

   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<form id="form-register">
   <div class="m-auto p-2">
      <div class="container border rounded bg-light p-4" style="max-width: 600px;">
         <h4>Ajax Form + Google reCAPTCHA</h4>
         <div class="form-group">
            <label for="name">Your name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" maxlength="50" autocomplete="off">
         </div>
         <div class="form-group">
            <label for="email">Your email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="email" name="email" maxlength="50" autocomplete="off">
         </div>
         <div class="form-group">
            <label for="message">Message <span class="text-danger">*</span></label>
            <textarea class="form-control" id="message" name="message" rows="3" maxlength="200"></textarea>
         </div>
         <div class="form-group">
            <label for="verify">Verify <span class="text-danger">*</span></label>
            <div id="show-recaptcha"></div>
            <input type="hidden" class="form-control" id="token" name="token">
         </div>
         <button type="button" class="btn btn-success w-100" id="btn-submit">Submit</button>
      </div>
   </div>
</form>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer></script>
<script type="text/javascript">

    var widgetId1;
    var onloadCallback = function() {
        //alert("grecaptcha is ready!");
        grecaptcha.render('show-recaptcha', {
            'sitekey' : 'YOUR_CLIENT_KEY'
        });
    };

   $('#btn-submit').on('click', function () {

       $('#token').val(grecaptcha.getResponse(widgetId1));

       if(!$('#name').val()){
           alert('Please input name');
           $('#name').focus();
           return false;
       }
       else if(!$('#email').val()){
           alert('Please input email');
           $('#email').focus();
           return false;
       }
       else if(!$('#message').val()){
           alert('Please input message');
           $('#message').focus();
           return false;
       }
       else if(!$('#token').val() || $('#token').val().length <= 0){
           alert('Please check reCAPTCHA');
           return false;
       }
       else {
           $.ajax({
               method: "POST",
               url: "save.php",
               data: $('#form-register').serialize()
           }).done(function( msg ) {
               if(parseInt(msg) === 1) {
                   Swal.fire(
                       'Good job!',
                       'reCAPTCHA is Valid !!',
                       'success'
                   );
               }
               else {
                   Swal.fire(
                       'Sorry!',
                       'Invalid reCAPTCHA !!',
                       'error'
                   );
               }
           });
       }

   });
</script>

</body>
</html>
