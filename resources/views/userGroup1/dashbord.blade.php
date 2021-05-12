@include('header.menu')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

  /* adjust font this page */
  .newFont {
    font-family: 'Mitr', sans-serif;
  }

  .newFonts {
    font-family: 'Mitr', sans-serif;
    font-size: 50px !important;
  }


  .dropdown .dropdown-menu .dropdown-item {
    font-size: 0.8rem;
    padding: 0;
  }

  /* adjust btn position */
  .button-position {
    float: right;
    margin: -8px;
  }



  td.break {
    word-wrap: break-word;
    /* word-break: break-all; */
    white-space: normal;
  }


  /* adjust btn size */
  .btns {
    padding: 0.9rem 2em;
    font-size: 0.875rem;
  }
</style>


<body>
  <!-- ------------------------------------------  include  --------------------------------------------->

  @include('partials.navbar')
  @include('partials.sidebar')
  <!-- ------------------------------------------  include  --------------------------------------------->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="newFont"> กราฟตัวชี้วัด</h3>
        <button class="btn btn-gradient-info btn-md m-3 mdi mdi-arrow-left newFont" onclick="goBack()" >ย้อนกลับ</button>
      </div>
      @foreach($dataKR as $i => $data)
      @if($data->percent==null)
      <input type="hidden" value="0" id={{$data->mount}}>
      @else
      <input type="hidden" value={{$data->percent}} id={{$data->mount}}>

      @endif
      @endforeach
      <!-- chart-year -->
      <!-- <div class="row">
        <div class="col">
          <div id="chart-year">
          </div>
        </div>
      </div> -->
      <!-- chart-quarter -->
      <div class="row">
        <div class="col">
          <div id="chart-quarter">
          </div>
        </div>
      </div>
      <!-- chart-month -->
      <div class="row">
        <div class="col">
          <div id="chart-month">
          </div>
        </div>
      </div>
    </div>
    @include('partials.footer')
  </div>
  <!-- chart-month -->
  <script>
    var str1 = document.getElementById("1").value;
    var str2 = document.getElementById("2").value;
    var str3 = document.getElementById("3").value;
    var str4 = document.getElementById("4").value;
    var str5 = document.getElementById("5").value;
    var str6 = document.getElementById("6").value;
    var str7 = document.getElementById("7").value;
    var str8 = document.getElementById("8").value;
    var str9 = document.getElementById("9").value;
    var str10 = document.getElementById("10").value;
    var str11 = document.getElementById("11").value;
    var str12 = document.getElementById("12").value;
    console.log(str5);
    var optionsMonth = {
      series: [{
        name: 'ร้อยละ',
        data: [str1, str2, str3, str4, str5, str6, str7, str8, str9, str10, str11, str12]
      }, ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
      },
      fill: {
        opacity: 1
      },
    };
    var chartQuarter = new ApexCharts(document.querySelector("#chart-month"), optionsMonth);
    chartQuarter.render();
  </script>
</body>
<!-- chart-year -->
<script>
  $('select').selectpicker();

  var optionsYear = {
    series: [{
        name: 'Q1',
        data: [30, 40, 50]
      },
      {
        name: 'Q2',
        data: [54, 85, 40]
      },
      {
        name: 'Q3',
        data: [43, 63, 50]
      }
    ],
    chart: {
      type: 'bar',
      height: 350
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: ['2562', '2563', '2564'],
    },
    // yaxis: {
    //   title: {
    //     text: '$ (thousands)'
    //   }
    // },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart-year"), optionsYear);
  chart.render();
</script>
<!-- chart-quarter -->
<script>
  var str1 = document.getElementById("1").value;
  var str2 = document.getElementById("2").value;
  var str3 = document.getElementById("3").value;
  var str4 = document.getElementById("4").value;
  var str5 = document.getElementById("5").value;
  var str6 = document.getElementById("6").value;
  var str7 = document.getElementById("7").value;
  var str8 = document.getElementById("8").value;
  var str9 = document.getElementById("9").value;
  var str10 = document.getElementById("10").value;
  var str11 = document.getElementById("11").value;
  var str12 = document.getElementById("12").value;
  var q1 = (parseInt(str1) + parseInt(str2) + parseInt(str3)) / 3;
  var q2 = (parseInt(str4) + parseInt(str5) + parseInt(str6)) / 3;
  var q3 = (parseInt(str7) + parseInt(str8) + parseInt(str9)) / 3;
  var q4 = (parseInt(str10) + parseInt(str11) + parseInt(str12)) / 3;
  var optionsQuarter = {
    series: [{
      name: 'ร้อยละ',
      data: [q1.toFixed(2), q2.toFixed(2), q3.toFixed(2), q4.toFixed(2)]
    }, ],
    chart: {
      type: 'bar',
      height: 350
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: ['Q1', 'Q2', 'Q3', 'q4'],
    },
    fill: {
      opacity: 1
    },
  };
  var chartQuarter = new ApexCharts(document.querySelector("#chart-quarter"), optionsQuarter);
  chartQuarter.render();

  function goBack() {
    window.history.back();
  }
</script>