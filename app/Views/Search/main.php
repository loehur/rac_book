<div>
  <div class="d-flex justify-content-between">
    <div class="w-100 px-1">
      <input name="no" class="form-control input" placeholder="No. HP"></input>
    </div>
    <div class="w-100 px-1">
      <input name="na" class="form-control input" placeholder="Nama"></input>
    </div>
    <div class="w-100 px-1"><span onclick="cek()" class="btn btn-primary">Search</span></div>
  </div>

  <div id="load" class="p-1 mt-1">

  </div>
</div>

<script>
  function cek() {
    let no = $("input[name=no]").val();
    let na = $("input[name=na]").val();

    if (no == '' && na == '') {
      return;
    }

    $("div#load").load('<?= URL::BASE_URL ?>Load/spinner/2', function() {
      $("div#load").load('<?= URL::BASE_URL ?>Search/cek', {
        "no": no,
        "na": na
      });
    });
  }

  $('.input').keypress(function(e) {
    if (e.which == 13) {
      cek();
    }
  });
</script>