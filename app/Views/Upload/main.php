<div class="p-1 mt-2">
  <div class="d-flex justify-content-between">
    <div><span class="btn btn-info cek">Cek Total Data</span></div>
    <div id="info2"></div>
  </div>
</div>
<hr>

<div class="p-1">
  <form action="<?= URL::BASE_URL ?>Upload/up_data" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <input type="file" class="form-control-file" name="file" required>
      <small>CSV Fields: <span class="text-primary">no_hp | nama</span></small>
      <button type="submit" class="btn btn-primary">Upload</button>
    </div>
  </form>
  <div id="info"></div>
</div>

<script>
  $(".cek").click(function() {
    $.ajax({
      url: '<?= URL::BASE_URL ?>Upload/cek',
      data: {},
      type: 'POST',
      success: function(res) {
        $("#info2").html('<div class="alert alert-light" role="alert">' + res + '</div>');
      },
    });
  })

  $("form").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      data: new FormData(this),
      type: $(this).attr("method"),
      enctype: 'multipart/form-data',
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function() {
        $("div#info").load('<?= URL::BASE_URL ?>Load/spinner/2');
        $("button").attr("disabled", true);
      },
      success: function(res) {
        $("#info").html('<div class="alert alert-light" role="alert">' + res + '</div>');
      },
    });
  });
</script>