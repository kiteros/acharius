<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
var id = <?php echo $_GET['id'];?>;
$.ajax({
  url: "http://80.218.58.46:777/?save_image=" + id,
  context: document.body
}).done();

window.location.href="../account/";
</script>
