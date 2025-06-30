<div>
  <div class="d-flex justify-content-between">
    <div class="w-100 px-1">
      <input name="se" class="form-control input" placeholder="No. HP/Nama"></input>
    </div>
    <div class="w-100 px-1"><span onclick="cek()" class="btn btn-primary">Search</span></div>
  </div>

  <div id="load" class="p-1 mt-1">

  </div>
</div>

<script>
  function cek() {
    let data = $("input[name=se]").val();
    if (data == '') {
      return;
    }

    $("div#load").load('<?= URL::BASE_URL ?>Load/spinner/2', function() {
      $("div#load").load('<?= URL::BASE_URL ?>Search/cek/' + data);
    });
  }

  $('.input').keypress(function(e) {
    if (e.which == 13) {
      cek();
    }
  });
</script>