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
</style>




<body>

    @include('partials.navbar')
    @include('partials.sidebar')


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="newFont"> แบบฟอร์มประเมินของฝ่ายบริหารและธุรการทั่วไป </h3>
            </div>
            <!-- แบบฟอร์มส่วนที่ 2 start -->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="newFont">ส่วนที่ 2 ตัวชี้วัดตามเกณฑ์การประเมินหน่วยงาน (9 ข้อ) จาก ทมอ.</h3><br>
                        <hr><br>
                        <!-- <p class="card-description"> Basic form elements </p> -->
                        <form class="forms-sample">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="newFont">หัวข้อ</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="newFont">คะแนนเต็ม</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="newFont">ผล</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="newFont">ร้อยละผลสำเร็จ</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="newFont">คะแนนที่ได้</label>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">1. ร้อยละผลสำเร็จการใช้งานระบบ DOMS (เริ่มตั้งแต่ มค.64)</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">2. ร้อยละการบันทึกงานประจำวันของพนักงาน</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">3. ร้อยละของคะแนนประเมิน 5ส</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">4. ร้อยละของการประหยัดพลังงาน go green</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">5. เว็บไซต์ หน่วยงานทั้งภาษาไทยและภาษาอังกฤษ</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">2</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">2</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">6. ร้อยละของการดำเนินงานและการใช้จ่ายงบประมาณตามแผนฯ ประจำปี</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">7. การปฏิบัติตามหลักวินัยทางการเงิน</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">8. การเข้าร่วมกิจกรรมกลางของมหาวิทยาลัย</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="newFont">9. ผลการประเมินคุณธรรม</div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="newFont">1</div>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                    <input type="text" class="form-control" placeholder="ตัวเลข" required>
                                </div>
                                <div class="col-md-2"> 
                                <div class="newFont">1</div>
                                </div>


                                <div class="form-group col-md-12"></div>
                                <div class="form-group col-md-8"></div>
                                <div class="form-group col-md-4">
                                    <div class="button-position">
                                        <button type="submit" class="btn btn-gradient-primary mr-2 newFont">บันทึก</button>
                                        <button type="submit" class="btn btn-light mr-2 newFont">ยกเลิก</button>
                                    </div>
                                </div>
                        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- สร้างตัวชี้วัด end -->

           

        </div>
        @include('partials.footer')
    </div>
    <!-- Div nav & side -->
    </div>
    </div>


</body>