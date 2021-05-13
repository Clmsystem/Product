@include('header.menu')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

  .newFont {
    font-family: 'Mitr', sans-serif;
  }

  .button-position {
    float: right;
    margin: -8px;
  }

  .btns {
    padding: 0.9rem 2em;
    font-size: 0.875rem;
  }

  td {
    text-align: center;
  }

  .textleft {
    text-align: left;
  }

  td.break {
    word-wrap: break-word;
    /* word-break: break-all; */
    white-space: normal;
  }

  th {
    text-align: center;
  }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
  function ModalEditData(id, name, result, percent, job) {
    document.getElementById('stratetegic_ID_edit').value = id;
    document.getElementById('stratetegic_name_edit').value = name;
    document.getElementById('result_edit').value = result;
    document.getElementById('percent_edit').value = percent;
    document.getElementById('job_edit').value = job;
  };
</script>

<body>
  @include('partials.navbar')
  @include('partials.sidebar')
  <!-- partial -->
  <div class="main-panel">
    <div class="container-fluid content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="page-header">
            <h3 class="newFont">ส่วนที่ 4 ผลการดำเนินงานตามตัวชี้วัดยุทธศาสตร์ ประจำปีงบประมาณ {{$years}}</h3>
          </div>
        </div>

        <div class="form-group col-md-4">
          <form action="{{route('resultshowmountsec4')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <select id="client_id" type="dropdown-toggle" class="form-control" name="mount">
              <optgroup>
                <option value="1" {{ $mount == 1 ? 'selected' : '' }}>มกราคม</option>
                <option value="2" {{ $mount == 2 ? 'selected' : '' }}>กุมภาพันธ์</option>
                <option value="3" {{ $mount == 3 ? 'selected' : '' }}>มีนาคม</option>
                <option value="4" {{ $mount == 4 ? 'selected' : '' }}>เมษายน</option>
                <option value="5" {{ $mount == 5 ? 'selected' : '' }}>พฤษภาคม</option>
                <option value="6" {{ $mount == 6 ? 'selected' : '' }}>มิถุนายน</option>
                <option value="7" {{ $mount == 7 ? 'selected' : '' }}>กรกฎาคม</option>
                <option value="8" {{ $mount == 8 ? 'selected' : '' }}>สิงหาคม</option>
                <option value="9" {{ $mount == 9 ? 'selected' : '' }}>กันยายน</option>
                <option value="10" {{ $mount == 10 ? 'selected' : '' }}>ตุลาคม</option>
                <option value="11" {{ $mount == 11 ? 'selected' : '' }}>พฤศจิกายน</option>
                <option value="12" {{ $mount == 12 ? 'selected' : '' }}>ธันวาคม</option>
              </optgroup>
            </select>
          </form>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h3 class="newFont"> กรอกข้อมูลตัวชี้วัด </h3><br>
              <div class="col-md-12">
                <table class="table table-bordered newFont">
                  <thead>
                    <tr class="d-flex">
                      <th class="col-sm-1" scope="col">
                        <h7 class="newFont">ลำดับ</h7>
                      </th>
                      <th class="col-sm-2" scope="col">
                        <h7 class="newFont">ตัวชี้วัดตามคำรับรอง</h7>
                      </th>
                      <th class="col-sm-2" scope="col">
                        <h7 class="newFont">เป้าหมาย<br>ตามคำรับรอง</h7>
                      </th>
                      <th class="col-sm-1" scope="col">
                        <h7 class="newFont">ผล</h7>
                      </th>
                      <th class="col-sm-1" scope="col">
                        <h7 class="newFont">ร้อยละ<br>ผลสำเร็จ</h7>
                      </th>
                      <th class="col-sm-3" scope="col">
                        <h7 class="newFont">งานที่สำเร็จแล้ว/<br>งานที่จะดำเนินการในอนาคต</h7>
                      </th>
                      <th class="col-sm-2" scope="col">แก้ไข</th>
                    </tr>
                  </thead>
                  <?php
                  $i = 0;
                  ?>
                  @foreach ($ob as $data)
                  <?php
                  $i += 1;
                  ?>
                  <tbody>
                    <tr class="d-flex">
                      <td class="col-sm-1"> <?php echo ($i); ?> </td>
                      <td class="col-sm-2 break textleft">{{$data->indicator_stratetegic_name}} </td>
                      <td class="col-sm-2 textleft">{{$data->goal}}</td>
                      <td class="col-sm-1">{{$data->result}}</td>
                      <td class="col-sm-1">{{$data->percent}}</td>
                      <td class="col-sm-3">{{$data->job}}</td>
                      <td class="col-sm-2 break">
                        @if (count($status)>0)
                        <button class="btn btn-gradient-success newFont" data-toggle="modal" data-target="#editindicator" onclick="ModalEditData({{$data->stratetegic_ID}},'{{$data->indicator_stratetegic_name}}','{{$data->result}}','{{$data->percent}}','{{$data->job}}');"><i class="mdi mdi-grease-pencil launch-modal"></i></button>
                        @else
                        <button class="btn btn-gradient-warning newFont"><i class="mdi mdi-lock launch-modal"></i></button>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
          <!--box edit -->
          <div class="modal fade" id="editindicator" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <br>
                  <h2 class="modal-title newFont" id="exampleModalLabel">แก้ไขผลการดำเนินงานตามตัวชี้วัดยุทธศาสตร์</h2>
                  <form class="forms-sample" action="{{route('updateDataSec4')}}" method="post">
                    @csrf
                    <hr><br>
                    <div class="row">
                      <input type="hidden" id="stratetegic_ID_edit" name="id">
                      <div class="form-group col-md-4">
                        <label class="newFont">ตัวชี้วัดตามคำรับรอง</label>
                        <input type="text" class="form-control" placeholder="ตัวชี้วัดตามคำรับรอง" value="" id="stratetegic_name_edit" name="name" required>
                      </div>

                      <div class="form-group col-md-4">
                        <label class="newFont">ผล</label>
                        <input type="text" class="form-control" placeholder="ผล" id="result_edit" name="result">
                      </div>
                      <div class="form-group col-md-4">
                        <label class="newFont">ร้อยละผลสำเร็จ</label>
                        <input type="text" class="form-control" placeholder="ร้อยละผลสำเร็จ" id="percent_edit" name="percent" required>
                      </div>

                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label class="newFont">งานที่สำเร็จแล้ว/งานที่จะดำเนินการในอนาคต</label>
                        <textarea type="text" style="height: 100px" class="form-control" placeholder="งานที่สำเร็จแล้ว/งานที่จะดำเนินการในอนาคต" id="job_edit" name="job" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <h7 class="newFont">ยกเลิก</h7>
                      </button>
                      <input type="submit" value="บันทึก" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('partials.footer')
      </div>
    </div>
  </div>
  </div>

</body>
<script type="text/javascript">
  var select = document.getElementById('client_id');
  select.addEventListener('change', function() {
    this.form.submit();
  }, false);
</script>