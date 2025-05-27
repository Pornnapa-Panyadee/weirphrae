
<style>
    .pcoded-mtext{
        font-size: 20px;
    }
</style>
<nav class="pcoded-navbar" >
    <div class="pcoded-inner-navbar">
        <ul class="pcoded-item">
            <li class="pcoded-hasmenu">
                <a  href="javascript:void(0)" >
                <span class="pcoded-mtext"><i class="feather icon-sidebar"></i>  ข้อมูลการตรวจประเมินสภาพฝาย</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ asset('/report/map') }}" >
                          <span class="pcoded-mtext">แผนที่ตำแหน่งฝายตามสภาพฝาย</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('report/chart?amp=sum') }}" >
                          <span class="pcoded-mtext">กราฟแสดงสัดส่วนของสภาพฝาย</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('/report/scoreComposition') }}" class="waves-effect " >
                          <span class="pcoded-mtext">ตารางรายงานสรุปผลสภาพฝาย</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('/report/problem') }}" class="waves-effect " >
                          <span class="pcoded-mtext">รายงานสภาพและแนวทางแก้ไขปัญหา</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a  href="javascript:void(0)" >
                <span class="pcoded-mtext"><i class="feather icon-map"></i> ข้อมูลตะกอนหน้าฝาย </span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ asset('/report/sediment') }}" >
                          <span class="pcoded-mtext">แผนที่ตำแหน่งฝายตามปริมาณตะกอน</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('report/sedimentTable') }}" >
                          <span class="pcoded-mtext">ตารางรายงานสรุปข้อมูลปริมาณตะกอน</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a  href="javascript:void(0)" >
                <span class="pcoded-mtext"><i class="fa fa-map-pin"></i> ปรับปรุง/เพิ่มเติมสภาพฝาย </span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="https://forms.gle/mjPJi6VQjQSEt2ro6" target=_blank>
                          <span class="pcoded-mtext">ฟอร์มสำรวจ</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('pdf/manual_prepare_weir_LP.pdf') }}" target=_blank>
                          <span class="pcoded-mtext">คู่มือการกรอกแบบสำรวจ</span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>

            <li class="pcoded-hasmenu">
                <a  href="javascript:void(0)" >
                <span class="pcoded-mtext"><i class="fa fa-sticky-note-o"></i> เกี่ยวกับโครงการ </span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ asset('/about') }}" >
                          <span class="pcoded-mtext">ข้อมูลโครงการ</span>
                        </a>
                    </li>
                    <!-- <li class="">
                        <a href="https://watercenter.scmc.cmu.ac.th/blockage/jang_basin">
                          <span class="pcoded-mtext">เว็บไซต์สิ่งกีดขวางทางน้ำ</span>
                        </a>
                    </li> -->
                    
                </ul>
            </li>

            <!-- <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" >
                    <span class="pcoded-mtext"><i class="feather icon-box"></i> คลังความรู้</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="https://blockage.crflood.com/mapthai/chiangrai" target="_blank" >
                          <span class="pcoded-mtext">IDF Curve รายอำเภอ (จ.ลำปาง) </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('/project') }}" target="_blank" >
                          <span class="pcoded-mtext">โครงการปรับปรุงฝายในพื้นที่นำร่อง</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ asset('/manual') }}" target="_blank" >
                          <span class="pcoded-mtext">คู่มือการใช้งานเว็บไซต์</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <!-- <li class="pcoded-hasmenu">
                <a href="{{ asset('/about') }}" >
                    <span class="pcoded-mtext"><i class="fa fa-sticky-note-o"></i> เกี่ยวกับโครงการ</span>
                </a>
               
            </li> -->
            <li class="pcoded-hasmenu">
                <a href="{{ asset('/contact') }}" >
                    <span class="pcoded-mtext"><i class="fa fa-comment-o"></i> ติดต่อเรา</span>
                </a>
                
            </li>
        </ul>
    </div>
</nav>