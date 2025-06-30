<style>
  .row-disabled {
    background-color: rgba(236, 240, 241, 0.5);
    pointer-events: none;
    width: 100%;
  }
</style>
<div class="row mx-0">
  <div class="col px-0">
    <div class="card">
      <div class="card-header">
        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Tambah
        </button>
      </div>
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>
            <?php
            $no = 0;
            foreach ($data as $a) {
              $no++;

              $id = $a['id_user'];
              $f2name = "";
              $f3 = $a['id_privilege'];
              $f3name = "";

              if ($f3 <> 100) {
                $classAdmin = "";
              } else {
                $classAdmin = "row-disabled";
              }

              echo "<tr class='" . $classAdmin . "'>";
              echo "<td>";
              echo "<span data-mode=2 data-id_value='" . $id . "' data-value='" . $a['nama_user'] . "'><b>" . $a['nama_user'] . "</b></span><br><span data-mode=5 data-id_value='" . $id . "' data-value='" . $f3name . "'>" . $f3name . "</span>";
              echo "</td>";
              echo "<td>" . $no . "#" . $id . " <span data-mode=4 data-id_value='" . $id . "' data-value='" . $f2name . "'>" . $f2name . "</span><br><span data-mode=6 data-id_value='" . $id . "' data-value='" . $a['no_user'] . "'>" . $a['no_user'] . "</span></td>";
              echo "<td class='text-right'>";
              echo " ";
              echo "</td>";
              if ($f3 <> 100) {
                if ($a['en'] == 1) {
                  echo "<td><a data-id_value='" . $id . "' data-value='0' class='text-danger enable' href='#'><i class='fas fa-times-circle'></i></a></td>";
                } else {
                  echo "<td><a data-id_value='" . $id . "' data-value='1' class='text-success enable' href='#'><i class='fas fa-recycle'></i></a></td>";
                }
              } else {
                echo "<td></td>";
              }
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= URL::BASE_URL; ?>Data_List/insert/user" method="POST">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="f1" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Phone Number</label>
                  <input type="text" name="f5" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Privilege</label>
                  <select name="f4" class="form-control" required>
                    <option value="0" selected>Viewer</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>

<script>
  $(document).ready(function() {
    $("form").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: $(this).attr("method"),
        success: function(res) {
          if (res == 0) {
            location.reload(true);
          } else {
            alert(res);
          }
        },
      });
    });

    var click = 0;
    $("span").on('dblclick', function() {
      click = click + 1;
      if (click != 1) {
        return;
      }

      var id_value = $(this).attr('data-id_value');
      var value = $(this).attr('data-value');
      var mode = $(this).attr('data-mode');
      var value_before = value;
      var span = $(this);

      var valHtml = $(this).html();

      switch (mode) {
        case '1':
        case '2':
        case '6':
        case '7':
        case '10':
          span.html("<input type='text' id='value_' value='" + value + "'>");
          break;
        default:
      }

      $("#value_").focus();
      $("#value_").focusout(function() {
        var value_after = $(this).val();
        if (value_after === value_before) {
          span.html(value);
          click = 0;
        } else {
          $.ajax({
            url: '<?= URL::BASE_URL ?>Data_List/updateCell/user',
            data: {
              'id': id_value,
              'value': value_after,
              'mode': mode
            },
            type: 'POST',
            dataType: 'html',
            success: function(response) {
              if (response == 0) {
                location.reload(true);
              } else {
                alert(response);
              }
            },
          });
        }
      });
    });

    $(".enable").on("click", function(e) {
      e.preventDefault();
      var id_value = $(this).attr('data-id_value');
      var value = $(this).attr('data-value');
      $.ajax({
        url: "<?= URL::BASE_URL ?>Data_List/enable/" + value,
        data: {
          'id': id_value,
        },
        type: 'POST',
        success: function(response) {
          $('tr.tr' + id_value).remove();
          location.reload(true);
        },
      });
    });
  });
</script>