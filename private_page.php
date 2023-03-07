<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Private Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="notepad">
      <div id="paper">
        <pre id="content"><?php echo htmlspecialchars(file_get_contents('notes.txt')); ?></pre>
        <div id="cursor"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      // Get the initial content of the notes file
      var initialContent = $('#content').html();
      
      // Check for changes in the notes file every 3 seconds
      setInterval(function() {
        $.get('notes.txt', function(data) {
          if (data !== initialContent) {
            // Add a typing animation to the new content
            var newContent = data.replace(/\n/g, '<br>');
            var cursor = $('#cursor');
            cursor.before('<span class="typing">' + newContent + '</span>');
            cursor.hide();
            var delay = 0;
            $('.typing').each(function() {
              var line = $(this);
              delay += 100;
              setTimeout(function() {
                line.removeClass('typing');
                cursor.show();
              }, delay);
            });
            initialContent = data;
          }
        });
      }, 3000);
    </script>
  </body>
</html>
