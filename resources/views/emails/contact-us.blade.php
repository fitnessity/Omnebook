@include('emails.header')
    <br>
    <b>Name :</b> <?php echo $name; ?> <br><br>
    <b>Email :</b> <?php echo $email; ?> <br><br>
    <b>Message :</b> <br><?php echo $post_message; ?>

@include('emails.footer')