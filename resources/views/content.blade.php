
<style>
    @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

    /* adjust font this page */
    .newFont {
        font-family: 'Mitr', sans-serif;
    }

    .pp {
        margin-top: 17px;
        margin-left: 85px;
    }

    /* adjust btn position */
    .text-t {
        margin: 0;
        padding: 0;
    }

    .resizeimg {
        width: 100%;
        height: 100%;
    }

    .roundeds {
        border-radius: 20px
    }

    .marginer {
        margin: 20px;
    }

    .pos {
        align-items: center;
    }
    .content-wrapper {
    background: #f2edf3;
    padding: 1.75rem 2.25rem;
    width: 100%;
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
}

</style>


<div class="content-wrapper">
   

    <div class="page-header">
        
        <h3 class="newFont"> ฝ่ายส่งเสริมการเรียนรู้และให้บริการการศึกษา ศูนย์บรรณสารและสื่อการศึกษา </h3>
        <iframe scrolling="no" frameborder="no" clocktype="html5" style="overflow:hidden;border:0;margin:0;padding:0;width:240px;height:25px;" src="https://www.clocklink.com/html5embed.php?clock=018&timezone=Thailand_Bangkok&color=black&size=240&Title=&Message=&Target=&From=2021,1,1,0,0,0&DateFormat=d / MMM / yyyy DDD&TimeFormat=hh:mm:ss TT&Color=gray"></iframe>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h3 class="newFont">ยินดีต้อนรับ คุณ{{ session()->get('user')['name_employee'] }}</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ session()->get('user')['img'] }}" class="resizeimg roundeds" alt="profile">
                        </div>
                        <div class="col-md-6">
                            <div class="marginer">
                                <br>
                                <h4 class="newFont">ชื่อ-สกุล : {{ session()->get('user')['name_employee'] }}</h4>
                                <br>
                                <h4 class="newFont">ตำแหน่ง : {{ session()->get('user')['name_position'] }}</h4>
                                <br>
                                <h4 class="newFont">แผนก : {{ session()->get('user')['name_department'] }}</h4>
                                <br>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
