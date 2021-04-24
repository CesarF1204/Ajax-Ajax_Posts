<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="/user_guide/js/jquery3.6v.js"></script>
    <link rel="stylesheet" href="/user_guide/css/style.css">
    <script>
        $(document).ready(function(){
            // we are getting all of the quotes so that when the user first requests the page the page 
            // will already be rendering the quotes
            $.get('posts/index_html', function(res) {
            // this url returns html string so we can dump that straight into div#quotes
            $('#posts').html(res);
            });
            $('form').submit(function(){
            // there are three arguments that we are passing into $.post function
            //     1. the url we want to go to: '/quotes/create'
            //     2. what we want to send to this url: $(this).serialize()
            //            $(this) is the form and by calling .serialize() function on the form it will 
            //            send post data to the url with the names in the inputs as keys
            //     3. the function we want to run when we get a response:
            //            function(res) { $('#quotes').html(res) }
            $.post($(this).attr('action'), $(this).serialize(), function(res) {
                $('#posts').html(res);
            });
            // We have to return false for it to be a single page application. Without it,
            // jQuery's submit function will refresh the page, which defeats the point of AJAX.
            // The form below still contains 'action' and 'method' attributes, but they are ignored.
            return false;
            });
        });
    </script>
</head>
<body>
    <div id="posts"></div>
<?php   if($this->session->flashdata('errors')) { ?>
        <?= $this->session->flashdata('errors') ?>
<?php   } else if($this->session->flashdata('success')) { ?>
        <?= $this->session->flashdata('success') ?>
<?php   } ?>
    <form action="/posts/create" method="post">
        <label for="post">Add a Note: </label>
        <textarea name="quote" id="post" cols="30" rows="10"></textarea>

        <label>Author: </label>
        <input type="text" name="author">
        
        <input type="submit" value="Post It!">
    </form>
</body>
</html>