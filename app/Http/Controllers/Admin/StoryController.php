<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Tag;
use App\Http\Models\Category;
use App\Http\Models\Story;
use App\Helpers\Common;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class StoryController extends Controller
{
    public function index()
    {
      $stories = Story::with('categories', 'tags')->paginate(30);
      return view('backend.story.index', compact('stories'));
    }

    public function automatic()
    {
      //$this->arrayDownload();
      $this->ifDownload();
    }

     public function ifDownload()
    {
      /*$arr = [];
      for($i = 1; $i < 2; $i++ ) {
        // xong a,b, c, d, e
      $parents = file_get_html('http://gactruyen.com/truyen-do-thi/page/'.$i.'?first-letter=y');
        //$parents = file_get_html('http://gactruyen.com/truyen-do-thi');
        foreach($parents->find('.poster') as $parent) {
          foreach($parent->find('a') as $childs) {
            if(!in_array($childs->href, $arr)) {
              array_push($arr, $childs->href); 
            }
            
          }
        }
      }
      dd($arr);*/
     $arr = [ 
        "http://gactruyen.com/tieu-thuyet/muu-cua-hoa-nam-full.html",
"http://gactruyen.com/tieu-thuyet/anh-xin-dau-hang-full.html",
"http://gactruyen.com/tieu-thuyet/mang-dem-dong-phong-full.html",
"http://gactruyen.com/tieu-thuyet/aristocracy-club-cau-la%cc%a3c-bo%cc%a3-quy-to%cc%a3c.html",
"http://gactruyen.com/tieu-thuyet/anh-trai-em-gai-full.html",
"http://gactruyen.com/tieu-thuyet/ac-ma-ba-dao.html",
"http://gactruyen.com/tieu-thuyet/anh-hai-boss-dung-nghich-lua.html",
"http://gactruyen.com/tieu-thuyet/giau-tinh-yeu.html",
"http://gactruyen.com/tieu-thuyet/anh-chang-xau-tinh-full.html",
"http://gactruyen.com/tieu-thuyet/muoi-full-hot-nhien-chi-gian.html",
"http://gactruyen.com/tieu-thuyet/anh-khong-thich-the-gioi-nay-anh-chi-thich-em.html",
"http://gactruyen.com/tieu-thuyet/anh-yeu-em-rat-nhieu-full.html",
"http://gactruyen.com/tieu-thuyet/ac-ma-ba-yeu-chi-yeu-co-gai-nho-ngot-ngao.html",
"http://gactruyen.com/tieu-thuyet/duc-ban-full-thanh-yeu.html",
"http://gactruyen.com/tieu-thuyet/an-sat.html",
"http://gactruyen.com/tieu-thuyet/boss-dai-ca-em-muon-lam-vo-boss.html",
"http://gactruyen.com/tieu-thuyet/ba-xa-mua-duoc.html",
"http://gactruyen.com/tieu-thuyet/ba-dao-cho-choc-tong-giam-doc-nong-tinh.html",
"http://gactruyen.com/tieu-thuyet/bao-boi-chay-khong-thoat-dau.html",
"http://gactruyen.com/tieu-thuyet/bat-chap-tat-ca.html",
"http://gactruyen.com/tieu-thuyet/bao-boi-cua-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/bay-ngay-ai-full-tam.html",
"http://gactruyen.com/tieu-thuyet/bao-boi-ngoan-ngoan-de-ta-yeu-tieu-thanh-tan.html",
"http://gactruyen.com/tieu-thuyet/ba-xa-anh-chi-thuong-em.html",
"http://gactruyen.com/tieu-thuyet/ba-xa-anh-chi-thuong-em-2.html",
"http://gactruyen.com/tieu-thuyet/ban-chat-cua-di-full-hai-mat.html",
"http://gactruyen.com/tieu-thuyet/ban-gai-cua-thieu-gia-full.html",
"http://gactruyen.com/tieu-thuyet/ban-tinh-yeu-han-la-cach-toi-chiem-doat-em.html",
"http://gactruyen.com/tieu-thuyet/bo-y-quan-dao.html",
"http://gactruyen.com/tieu-thuyet/bi-thu-trung-sinh.html",
"http://gactruyen.com/tieu-thuyet/bao-boi-dang-yeu-cua-tong-giam-doc-bi-full.html",
"http://gactruyen.com/tieu-thuyet/nam-lay-tay-anh-nhe.html",
"http://gactruyen.com/tieu-thuyet/bac-tong-phong-luu.html",
"http://gactruyen.com/tieu-thuyet/bach-thieu-gia-cung-chieu-vo-nhu-mang.html",
"http://gactruyen.com/tieu-thuyet/bac-si-bach-da-lau-khong-gap.html",
"http://gactruyen.com/tieu-thuyet/bi-mat-cua-ong-xa-loi-noi-doi-ngot-ngao.html",
"http://gactruyen.com/tieu-thuyet/ba-ba.html",
"http://gactruyen.com/tieu-thuyet/bay-tinh-tinh-bay-full.html",
"http://gactruyen.com/tieu-thuyet/bo-roi-ma-vuong-tong-tai-full.html",
"http://gactruyen.com/tieu-thuyet/canh-lo-quan-do.html",
"http://gactruyen.com/tieu-thuyet/con-dau-nha-giau-full.html",
"http://gactruyen.com/tieu-thuyet/chong-giuong-hay-ghen.html",
"http://gactruyen.com/tieu-thuyet/chim-trong-cuoc-yeu.html",
"http://gactruyen.com/tieu-thuyet/chet-sap-bay-roi-full.html",
"http://gactruyen.com/tieu-thuyet/co-vo-bat-dac-di.html",
"http://gactruyen.com/tieu-thuyet/co-dau-24h-chong-a-em-khong-muon-lam-the-than.html",
"http://gactruyen.com/tieu-thuyet/cuc-pham-ta-thieu-full.html",
"http://gactruyen.com/tieu-thuyet/co-vo-gia-mao-rat-bi-vong-mac-cap.html",
"http://gactruyen.com/tieu-thuyet/cong-chua-hoa-anh-dao-full.html",
"http://gactruyen.com/tieu-thuyet/cha-tong-thong-cua-cuc-cung-sinh-doi.html",
"http://gactruyen.com/tieu-thuyet/cuoc-hon-nhan-dai-lau.html",
"http://gactruyen.com/tieu-thuyet/chung-toi-o-chung-nha.html",
"http://gactruyen.com/tieu-thuyet/cu-lanh-lung-di-roi-anh-se-mat-em.html",
"http://gactruyen.com/tieu-thuyet/chi-muon-lam-ong-xa-cua-em.html",
"http://gactruyen.com/tieu-thuyet/cuc-pham-thao-can-thai-tu.html",
"http://gactruyen.com/tieu-thuyet/cam-bay-hon-nhan.html",
"http://gactruyen.com/tieu-thuyet/cho-em-lon-duoc-khong.html",
"http://gactruyen.com/tieu-thuyet/chap-chuong-than-quyen.html",
"http://gactruyen.com/tieu-thuyet/cuc-cung-can-ro-tong-giam-doc-dam-cuop-me-cua-toi.html",
"http://gactruyen.com/tieu-thuyet/con-gai-cua-dai-ta.html",
"http://gactruyen.com/tieu-thuyet/co-tho-ngay-dung-hong-tron-full.html",
"http://gactruyen.com/tieu-thuyet/co-vo-bi-bo.html",
"http://gactruyen.com/tieu-thuyet/cam-tu-tinh-yeu-gap-go-tong-giam-doc-long-da-doc-ac.html",
"http://gactruyen.com/tieu-thuyet/cuong-yeu-doc-nhat-vo-nhi-giu-lay.html",
"http://gactruyen.com/tieu-thuyet/chi-du-anh-can-cau.html",
"http://gactruyen.com/tieu-thuyet/chut-chuyen-cua-thang-nu.html",
"http://gactruyen.com/tieu-thuyet/cung-chieu-ba-xa-sieu-sao-vo-yeu-cua-tong-giam-doc-cuong-da.html",
"http://gactruyen.com/tieu-thuyet/co-vo-nho-cua-anh-full.html",
"http://gactruyen.com/tieu-thuyet/cuc-pham-thuc-nu.html",
"http://gactruyen.com/tieu-thuyet/co-gan-hang-cua-dai-ca.html",
"http://gactruyen.com/tieu-thuyet/dinh-cap-luu-manh.html",
"http://gactruyen.com/tieu-thuyet/dai-niet-ban.html",
"http://gactruyen.com/tieu-thuyet/de-em-yeu-anh-lan-nua-full.html",
"http://gactruyen.com/tieu-thuyet/dung-noi-loi-tam-biet.html",
"http://gactruyen.com/tieu-thuyet/thi-tang-kieu.html",
"http://gactruyen.com/tieu-thuyet/duc-vong-den-toi-ban-full-thanh-yeu.html",
"http://gactruyen.com/tieu-thuyet/dai-boss-toi-thich-anh-sao.html",
"http://gactruyen.com/tieu-thuyet/doc-nu-pk-thay-giao-luu-manh.html",
"http://gactruyen.com/tieu-thuyet/doi-chong-cung-chieu-em-den-nghien.html",
"http://gactruyen.com/tieu-thuyet/do-thi-thieu-soai.html",
"http://gactruyen.com/tieu-thuyet/da-cuoi-la-phai-cuoi-den-noi-den-chon.html",
"http://gactruyen.com/tieu-thuyet/dac-cong-xuat-ngu.html",
"http://gactruyen.com/tieu-thuyet/danh-bai-linh-dac-chung.html",
"http://gactruyen.com/tieu-thuyet/do-choi-cua-tong-tai.html",
"http://gactruyen.com/tieu-thuyet/dao-tinh-ban-full.html",
"http://gactruyen.com/tieu-thuyet/do-thi-diem-phuc-hanh.html",
"http://gactruyen.com/tieu-thuyet/dich-vu-tinh-yeu-thue-nguoi-yeu.html",
"http://gactruyen.com/tieu-thuyet/dieu-uoc-cua-de-con.html",
"http://gactruyen.com/tieu-thuyet/dinh-menh-anh-va-em-2.html",
"http://gactruyen.com/tieu-thuyet/dai-ca-xa-hoi-den-cam-thu-tinh-khiet.html",
"http://gactruyen.com/tieu-thuyet/dem-den-o-hong-kong.html",
"http://gactruyen.com/tieu-thuyet/dong-phong-hoa-chuc-sat-vach-full.html",
"http://gactruyen.com/tieu-thuyet/do-thi-tu-chan.html",
"http://gactruyen.com/tieu-thuyet/do-ngoc-toi-thich-em-full.html",
"http://gactruyen.com/tieu-thuyet/vat-rieng-cua-tong-giam-doc-mau-lanh.html",
"http://gactruyen.com/tieu-thuyet/hon-nhan-manh-me-sep-tha-cho-toi-di.html",
"http://gactruyen.com/tieu-thuyet/cam-tu-tinh-yeu-gap-go-tong-giam-doc-long-da-doc-ac.html",
"http://gactruyen.com/tieu-thuyet/hon-ca-hon-nhan.html",
"http://gactruyen.com/tieu-thuyet/black-angel-thien-than-bong-toi.html",
"http://gactruyen.com/tieu-thuyet/hop-dong-hon-nhan-co-dau-14-tuoi.html",
"http://gactruyen.com/tieu-thuyet/do-heo-co-chet-voi-toi.html",
"http://gactruyen.com/tieu-thuyet/ngoc-dung-lai-cho-anh.html",
"http://gactruyen.com/tieu-thuyet/nu-hoang-va-duc-vua-cua-truong-world.html",
"http://gactruyen.com/tieu-thuyet/o-re-chue-te.html",
"http://gactruyen.com/tieu-thuyet/tuoi-xuan-cua-em-toa-thanh-cua-anh.html",
"http://gactruyen.com/tieu-thuyet/hoa-nguc.html",
"http://gactruyen.com/tieu-thuyet/27-nhat-dao-bi-an.html",
"http://gactruyen.com/tieu-thuyet/ai-noi-toi-ket-hon.html",
"http://gactruyen.com/tieu-thuyet/ngoc-quan-am.html",
"http://gactruyen.com/tieu-thuyet/khong-so-lam-hu-em.html",
"http://gactruyen.com/tieu-thuyet/bao-boi-chay-khong-thoat-dau.html",
"http://gactruyen.com/tieu-thuyet/yeu-phu-quan-keo-kiet.html",
"http://gactruyen.com/tieu-thuyet/thai-phan-diep.html",
"http://gactruyen.com/tieu-thuyet/lang-tich-huong-do.html",
"http://gactruyen.com/tieu-thuyet/hoc-vien-thien-tai.html",
"http://gactruyen.com/tieu-thuyet/bay-nam-van-ngoanh-ve-phuong-bac.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-sau-ly-hon.html",
"http://gactruyen.com/tieu-thuyet/con-anh-yeu-em-doc-chiem-bao-boi.html",
"http://gactruyen.com/tieu-thuyet/em-dam-ngu-voi-toi-chu-full.html",
"http://gactruyen.com/tieu-thuyet/em-gai-hu-yeu-ta.html",
"http://gactruyen.com/tieu-thuyet/gia-lam-tinh-nhan-xa-hoi-den-full.html",
"http://gactruyen.com/tieu-thuyet/gai-e-vung-len-khieu-chien-thieu-gia-ac-ma.html",
"http://gactruyen.com/tieu-thuyet/giao-dich-dem-dau-tien.html",
"http://gactruyen.com/tieu-thuyet/gat-le-cho-em.html",
"http://gactruyen.com/tieu-thuyet/giao-dich-trien-mien-co-vo-nuoi-tu-be-cua-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/ga-cho-vien-lang.html",
"http://gactruyen.com/tieu-thuyet/gio-mang-ky-uc-thoi-thanh-nhung-canh-hoa.html",
"http://gactruyen.com/tieu-thuyet/gia-yeu-lam-full-thanh-yeu.html",
"http://gactruyen.com/tieu-thuyet/hotgirls-sieu-quay.html",
"http://gactruyen.com/tieu-thuyet/hay-o-lai-trong-trai-tim-anh.html",
"http://gactruyen.com/tieu-thuyet/hao-mon-quyen-ngon-thieu-cung-chieu-vo-luong-nhat-da.html",
"http://gactruyen.com/tieu-thuyet/hat-tinh-ca-cho-em-full.html",
"http://gactruyen.com/tieu-thuyet/hop-dong-tinh-nhan.html",
"http://gactruyen.com/tieu-thuyet/hoi-uc-ve-thuan-kieu-plaza-full.html",
"http://gactruyen.com/tieu-thuyet/hao-mon-tuyet-luyen-tong-giam-doc-khong-yeu-van-cuong-ep.html",
"http://gactruyen.com/tieu-thuyet/hao-mon-thua-hoan-mo-thieu-xin-anh-hay-tu-trong.html",
"http://gactruyen.com/tieu-thuyet/hay-ve-ben-anh.html",
"http://gactruyen.com/tieu-thuyet/hac-dao-dac-chung-binh.html",
"http://gactruyen.com/tieu-thuyet/hoa-va-buom.html",
"http://gactruyen.com/tieu-thuyet/hong-sac-si-do.html",
"http://gactruyen.com/tieu-thuyet/hao-mon-thinh-sung-bao-boi-that-xin-loi.html",
"http://gactruyen.com/tieu-thuyet/hoang-tu-lanh-lung-va-co-nhoc-lanh-chanh-full.html",
"http://gactruyen.com/tieu-thuyet/hon-nhan-manh-me-sep-tha-cho-toi-di.html",
"http://gactruyen.com/tieu-thuyet/ho-hoa-cao-thu-tai-do-thi.html",
"http://gactruyen.com/tieu-thuyet/hop-dong-sinh-baby-full.html",
"http://gactruyen.com/tieu-thuyet/hon-trom-55-lan.html",
"http://gactruyen.com/tieu-thuyet/hon-nhan-khong-tinh-yeu.html",
"http://gactruyen.com/tieu-thuyet/hon-nhan-gia-ngan-vang.html",
"http://gactruyen.com/tieu-thuyet/hoa-bao-thien-vuong.html",
"http://gactruyen.com/tieu-thuyet/hop-dong-hon-nhan-100-ngay-full.html",
"http://gactruyen.com/tieu-thuyet/hao-mon-kinh-mong-full.html",
"http://gactruyen.com/tieu-thuyet/hon-nhan-tri-mang-gap-go-trum-mau-lanh.html",
"http://gactruyen.com/tieu-thuyet/ke-hoach-bat-cuu.html",
"http://gactruyen.com/tieu-thuyet/ke-hoach-mai-moi.html",
"http://gactruyen.com/tieu-thuyet/khong-nho-khong-quen.html",
"http://gactruyen.com/tieu-thuyet/ke-thu-cua-xu-nu-full.html",
"http://gactruyen.com/tieu-thuyet/khuynh-the-hoang-phi.html",
"http://gactruyen.com/tieu-thuyet/khong-che-duc-full.html",
"http://gactruyen.com/tieu-thuyet/khieu-khich-mat-khong-che-gap-go-nhan-vat-lon-cuc-pham-full.html",
"http://gactruyen.com/tieu-thuyet/khong-cho-tra-lai-ong-xa-full.html",
"http://gactruyen.com/tieu-thuyet/khi-nhi-tieu-thu-lam-hau-gai.html",
"http://gactruyen.com/tieu-thuyet/khac-tinh-cua-tong-tai.html",
"http://gactruyen.com/tieu-thuyet/lang-lo-tao-nha.html",
"http://gactruyen.com/tieu-thuyet/lam-cho-tong-giam-doc-full.html",
"http://gactruyen.com/tieu-thuyet/lua-gat-co-vo-nho-de-yeu.html",
"http://gactruyen.com/tieu-thuyet/lam-ban-voi-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/lang-tich-huong-do.html",
"http://gactruyen.com/tieu-thuyet/luu-luyen-khong-quen.html",
"http://gactruyen.com/tieu-thuyet/lung-linh-nhu-nuoc-full.html",
"http://gactruyen.com/tieu-thuyet/luat-su-phuc-hac-qua-nguy-hiem-full.html",
"http://gactruyen.com/tieu-thuyet/lo-lem-hien-dai.html",
"http://gactruyen.com/tieu-thuyet/loi-noi-doi-ngot-ngao-full.html",
"http://gactruyen.com/tieu-thuyet/lich-su-cua-nhan-vat-nho-trong-lang-giai-tri.html",
"http://gactruyen.com/tieu-thuyet/me-ngoc-nghech-con-thien-tai.html",
"http://gactruyen.com/tieu-thuyet/hoac-full.html",
"http://gactruyen.com/tieu-thuyet/me-hoac-dai-ca-hac-dao.html",
"http://gactruyen.com/tieu-thuyet/mi-hoac-vo-hinh.html",
"http://gactruyen.com/tieu-thuyet/me-that-dich-vinh-hang.html",
"http://gactruyen.com/tieu-thuyet/mot-dem-sau-cuoi.html",
"http://gactruyen.com/tieu-thuyet/mieng-doc-thanh-doi.html",
"http://gactruyen.com/tieu-thuyet/mot-dem-loan-dai-ca-xa-hoi-den-dung-toi-day.html",
"http://gactruyen.com/tieu-thuyet/mo-ra-ngoai-deo-lien-xuyen-qua.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-lam-tuoi-17.html",
"http://gactruyen.com/tieu-thuyet/nha-tu-nong-bong-tong-giam-doc-tha-cho-toi-di.html",
"http://gactruyen.com/tieu-thuyet/ngai-gi-yeu-nhau.html",
"http://gactruyen.com/tieu-thuyet/nha-co-su-tu-ha-dong-full.html",
"http://gactruyen.com/tieu-thuyet/nguc-tinh-cuong-thuong-gia-cuong.html",
"http://gactruyen.com/tieu-thuyet/nguoi-tinh-thung-cua-chu-tich-full.html",
"http://gactruyen.com/tieu-thuyet/neu-khong-phai-la-anh-full.html",
"http://gactruyen.com/tieu-thuyet/nuong-chieu-bao-boi-le-tinh-yeu-cua-bao-vuong.html",
"http://gactruyen.com/tieu-thuyet/nu-chinh-yeu-nam-phu.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-hai-mat-cua-toi.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-vo-chong-hai-hoa.html",
"http://gactruyen.com/tieu-thuyet/nam-ay-gap-duoc-anh.html",
"http://gactruyen.com/tieu-thuyet/ngoi-sao-lon-qua-cam-nho.html",
"http://gactruyen.com/tieu-thuyet/nguoi-dan-ong-cua-toi.html",
"http://gactruyen.com/tieu-thuyet/nga-re-di-ve-phia-anh-full.html",
"http://gactruyen.com/tieu-thuyet/nho-ngoc-anh-yeu-em.html",
"http://gactruyen.com/tieu-thuyet/nguoi-vo-thay-full-ngan-thien.html",
"http://gactruyen.com/tieu-thuyet/nhi-tieu-thu-em-se-thuoc-ve-ta.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-ngoc-nghech-cua-tong-giam-doc-full.html",
"http://gactruyen.com/tieu-thuyet/no-em-mot-hanh-phuc.html",
"http://gactruyen.com/tieu-thuyet/nang-osin-ca-tinh-va-chang-hotboy-lanh-lung.html",
"http://gactruyen.com/tieu-thuyet/nu-vuong-lanh-lung-van-van-tue.html",
"http://gactruyen.com/tieu-thuyet/ngu-cung-soi-dong-lang-cong-cham.html",
"http://gactruyen.com/tieu-thuyet/nguyen-yeu-em-lan-nua-full.html",
"http://gactruyen.com/tieu-thuyet/nhi-thieu-gia-xin-anh-cach-xa-toi-mot-met.html",
"http://gactruyen.com/tieu-thuyet/o-re-chue-te.html",
"http://gactruyen.com/tieu-thuyet/osin-noi-loan-full.html",
"http://gactruyen.com/tieu-thuyet/ong-xa-em-la-thu-nhan-full.html",
"http://gactruyen.com/tieu-thuyet/ong-chu-kieu-ngao-full.html",
"http://gactruyen.com/tieu-thuyet/ong-chu-la-cuc-pham.html",
"http://gactruyen.com/tieu-thuyet/ong-xa-phuc-hac-vo-ngoc-dang-yeu.html",
"http://gactruyen.com/tieu-thuyet/oanh-tac-bac-kinh.html",
"http://gactruyen.com/tieu-thuyet/om-em-di-diep-tu-vien.html",
"http://gactruyen.com/tieu-thuyet/ong-xa-khong-thuan-ba-xa-luu-manh.html",
"http://gactruyen.com/tieu-thuyet/oan-gia-anh-la-tong-tai-sao-full.html",
"http://gactruyen.com/tieu-thuyet/phu-quan-kiem-che-chut-full.html",
"http://gactruyen.com/tieu-thuyet/phuc-hac-khong-phai-toi.html",
"http://gactruyen.com/tieu-thuyet/quyen-ru-yeu-nghiet-thu-truong.html",
"http://gactruyen.com/tieu-thuyet/quan-dao-thien-kieu.html",
"http://gactruyen.com/tieu-thuyet/quan-khong-dung-dan-full.html",
"http://gactruyen.com/tieu-thuyet/quan-sung-co-vo-nho.html",
"http://gactruyen.com/tieu-thuyet/quyet-y-di-cung-anh-full.html",
"http://gactruyen.com/tieu-thuyet/quan-chinh-tam-thieu-dung-qua-phan.html",
"http://gactruyen.com/tieu-thuyet/quan-truong-thiet-luat.html",
"http://gactruyen.com/tieu-thuyet/quyen-tai.html",
"http://gactruyen.com/tieu-thuyet/quan-hon-tham-muu-truong-lam-ngot-tuc-gian.html",
"http://gactruyen.com/tieu-thuyet/quan-lo-thuong-do.html",
"http://gactruyen.com/tieu-thuyet/quyen-luyen-vo-truoc-xinh-dep.html",
"http://gactruyen.com/tieu-thuyet/sung-vat-hay-mon-choi.html",
"http://gactruyen.com/tieu-thuyet/san-truong-toan-nang-cao-thu.html",
"http://gactruyen.com/tieu-thuyet/say-khong-ve.html",
"http://gactruyen.com/tieu-thuyet/song-dong-em-dem.html",
"http://gactruyen.com/tieu-thuyet/sieu-cap-he-thong.html",
"http://gactruyen.com/tieu-thuyet/sac-mau-quan-nhan.html",
"http://gactruyen.com/tieu-thuyet/sep-ta-thuc-nhu-full.html",
"http://gactruyen.com/tieu-thuyet/sep-de-dat-mot-chut.html",
"http://gactruyen.com/tieu-thuyet/satan-lau-nam-full.html",
"http://gactruyen.com/tieu-thuyet/satan-diu-dang-nhat-duoc-co-vo-nho-dieu-le-tap.html",
"http://gactruyen.com/tieu-thuyet/sam-sam-den-day-ne-full.html",
"http://gactruyen.com/tieu-thuyet/soai-ca-em-den-day-de-anh-nguoc.html",
"http://gactruyen.com/tieu-thuyet/sap-bay-tro-choi-nguy-hiem.html",
"http://gactruyen.com/tieu-thuyet/su-diu-dang-kho-cuong.html",
"http://gactruyen.com/tieu-thuyet/suu-nu-dao-hoa.html",
"http://gactruyen.com/tieu-thuyet/song-cung-bieu-ty.html",
"http://gactruyen.com/tieu-thuyet/su-cam-cuoi-cung.html",
"http://gactruyen.com/tieu-thuyet/sa-nga-vo-toi-full-diep-lac-vo-tam.html",
"http://gactruyen.com/tieu-thuyet/sy-do-phong-luu.html",
"http://gactruyen.com/tieu-thuyet/sieu-cap-tuan-canh.html",
"http://gactruyen.com/tieu-thuyet/truy-duoi.html",
"http://gactruyen.com/tieu-thuyet/tinh-nguoi-duyen-ma.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-truoc-yeu-sau-phong-tu.html",
"http://gactruyen.com/tieu-thuyet/thuong-truong-dai-chien.html",
"http://gactruyen.com/tieu-thuyet/ta-than.html",
"http://gactruyen.com/tieu-thuyet/thuan-tay-dat-ra-mot-bao-bao.html",
"http://gactruyen.com/tieu-thuyet/trien-mien-khong-ngot.html",
"http://gactruyen.com/tieu-thuyet/thieu-nien-duoc-vuong.html",
"http://gactruyen.com/tieu-thuyet/thieu-gia-bi-bo-roi-full.html",
"http://gactruyen.com/tieu-thuyet/thu-quyen.html",
"http://gactruyen.com/tieu-thuyet/truy-tim-ky-uc-nguoi-dep-lam-nhan.html",
"http://gactruyen.com/tieu-thuyet/tu-dai-tai-phiet-dang-ky-ket-hon-tre.html",
"http://gactruyen.com/tieu-thuyet/truy-tim-ky-uc-dinh-mac.html",
"http://gactruyen.com/tieu-thuyet/thien-bong-toi-full.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-can-ba-xin-anh-dung-yeu-toi.html",
"http://gactruyen.com/tieu-thuyet/tong-tai-buc-hon-ngao-kho-thuan-phuc.html",
"http://gactruyen.com/tieu-thuyet/tro-thanh-vo-cua-tinh-dich.html",
"http://gactruyen.com/tieu-thuyet/trach-thien-ky.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-xin-anh-nhe-mot-chut.html",
"http://gactruyen.com/tieu-thuyet/toi-nay-muon-len-giuong.html",
"http://gactruyen.com/tieu-thuyet/thieu-gia-phuc-hac-san-vo-yeu.html",
"http://gactruyen.com/tieu-thuyet/thieu-gia-phong-luu.html",
"http://gactruyen.com/tieu-thuyet/truyen-tinh-yeu-quy-toc-full.html",
"http://gactruyen.com/tieu-thuyet/trum-tai-nguyen.html",
"http://gactruyen.com/tieu-thuyet/tac-giuong-giang-bac-thanh-nam.html",
"http://gactruyen.com/tieu-thuyet/tu-dai-cong-chua-tai-nang-va-tu-dai-cong-tu-lanh-lung.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-ac-ma-qua-yeu-vo.html",
"http://gactruyen.com/tieu-thuyet/tay-buong-tay-va-tim-thoi-nho.html",
"http://gactruyen.com/tieu-thuyet/chet-mim-cuoi-ba-xa-sat-thu-cua-tong-tai-hac-dao.html",
"http://gactruyen.com/tieu-thuyet/thoi-gian-dep-nhat-deu-cho-em.html",
"http://gactruyen.com/tieu-thuyet/tinh-yeu-nho-cua-dai-thanh.html",
"http://gactruyen.com/tieu-thuyet/thuong-ta-khong-quan-xau-xa.html",
"http://gactruyen.com/tieu-thuyet/toi-thich-em-buong-binh.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-tha-toi-di.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-hang-ty-cuop-lai-vo-truoc-da-sinh-con.html",
"http://gactruyen.com/tieu-thuyet/tinh-nhan-lam-am-giuong-cua-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/tong-giam-doc-lanh-lung-lua-tinh-thanh-nghien.html",
"http://gactruyen.com/tieu-thuyet/thao-dang-nien-hoa.html",
"http://gactruyen.com/tieu-thuyet/tinh-chien-phong-bao.html",
"http://gactruyen.com/tieu-thuyet/vo-yeu-xinh-dep-cua-tong-giam-doc-tan-ac.html",
"http://gactruyen.com/tieu-thuyet/vo-be-bong-cua-toi-full-3.html",
"http://gactruyen.com/tieu-thuyet/vo-toi-la-cong-chua.html",
"http://gactruyen.com/tieu-thuyet/vo-hien-bai-cong-full.html",
"http://gactruyen.com/tieu-thuyet/vo-ngoc-ah-em-tron-duoc-toi-sao-full.html",
"http://gactruyen.com/tieu-thuyet/vo-truoc-cua-tong-giam-doc-lanh-lung-full.html",
"http://gactruyen.com/tieu-thuyet/vo-bac-si-buong-binh-cua-thu-truong.html",
"http://gactruyen.com/tieu-thuyet/viec-xau-trong-nha.html",
"http://gactruyen.com/tieu-thuyet/vi-tinh-dau.html",
"http://gactruyen.com/tieu-thuyet/vo-yeu-nu-canh-sat-cua-thuong-tuong.html",
"http://gactruyen.com/tieu-thuyet/vo-lai-kim-tien.html",
"http://gactruyen.com/tieu-thuyet/vo-dich-quan-sung-co-vo-nho-nguoi.html",
"http://gactruyen.com/tieu-thuyet/vo-truoc-cua-tong-giam-doc-satan.html",
"http://gactruyen.com/tieu-thuyet/vo-truoc-cua-tong-tai-lanh-khoc.html",
"http://gactruyen.com/tieu-thuyet/vo-ho-oi-anh-yeu-em.html",
"http://gactruyen.com/tieu-thuyet/vit-con-anh-xin-loi-anh-yeu-em-full.html",
"http://gactruyen.com/tieu-thuyet/ve-si-than-cap-cua-nu-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/xam-chiem-tuyet-doi.html",
"http://gactruyen.com/tieu-thuyet/yeu-thuong-tinh-nhan-mot-dem-full.html",
"http://gactruyen.com/tieu-thuyet/yeu-anh-co-bao-gio-hanh-phuc.html",
"http://gactruyen.com/tieu-thuyet/yeu-gia-tinh-full.html",
"http://gactruyen.com/tieu-thuyet/y-dao-quan-do.html",
"http://gactruyen.com/tieu-thuyet/yeu-em-nhe-lao-dai-lanh-lung.html",
"http://gactruyen.com/tieu-thuyet/yeu-tuong-toi-khong-dam.html",
"http://gactruyen.com/tieu-thuyet/yeu-phai-nguoi-tinh-mot-dem.html",
"http://gactruyen.com/tieu-thuyet/yeu-nghiet-dong-cu.html",
"http://gactruyen.com/tieu-thuyet/yeu-em-duoc-khong.html",
"http://gactruyen.com/tieu-thuyet/yeu-doi-moi-em-full.html",
      ];

      foreach($arr as $link) {

        $html = file_get_html($link);
        //$html = file_get_html('http://gactruyen.com/tieu-thuyet/juliet-thanh-bach-van.html');

              foreach($html->find('.part1') as $index => $e) {
                  foreach($e->find('a') as $index => $elem) {
                    //if($index > 15) {
                        $link = $elem->href;

                    $wrapperContent = file_get_html($link);
                    $title = '';
                    $content = '';
                    $category = '';
                    $tag = '';
                    $number = 0;
                    $chapter = 0;
                    $ex = '';
                    $subtitle = '';

                      foreach($wrapperContent->find('.entry-title') as $block) {
                        $tag = $block->plaintext;
                        $title = $block->plaintext;
                        \Log::info($title);
                      }

                      /*foreach($wrapperContent->find('.detailchapter') as $block) {
                        $title = $block->plaintext;
                        if(strrpos($title, '.') === true) {
                          $n = explode('.', $title)[1];
                          $number = explode(' ', $n)[0];
                        } else {
                          $n = explode(':', $title)[0];
                          $number = explode(' ', $n)[1];
                        }
                      }*/

                      foreach($wrapperContent->find('.entry-subtitle') as $block) {
                        $subtitle = $block->plaintext;
                        if(strrpos($block->plaintext, '.')) {
                          $ex1 = (int) trim(explode('.', $block->plaintext)[1]);
                          $number = $ex1;

                          $ex2 = explode('.', $block->plaintext);
                          for($j=0; $j < count($ex2); $j++) {
                            if(strpos(strtolower($ex2[$j]), 'chương')) {
                              $ex = explode(' ', trim($ex2[$j]));
                              $chapter = (int) $ex[count($ex) - 1];
                            }  
                          }
                          /*$ex2 = explode(' ', $ex1);
                          $ex = (int) $ex2[count($ex2) - 1];
                          if(empty($title)) {
                            $title = explode('.', $block->plaintext)[1];
                          }*/
                          //$chapter = $ex;

                        } else {
                          if(strpos(strtolower($block->plaintext), 'chương')) {
                            $ex = explode(' ', $block->plaintext);
                            $chapter = (int) $ex[count($ex) - 1];
                          } else if(strpos($block->plaintext, '–') !== false) {
                            $chapter = trim(explode('–', $block->plaintext)[1]);
                          }
                          /*if(strpos($block->plaintext, '–') !== false) {
                            $ex = explode('–', $block->plaintext)[1];
                            if(is_numeric($ex)) {
                              $chapter = explode(' ', $ex)[1];  
                            } else {
                              $subtitle = trim($ex);
                            }
                            
                          } else if(strpos($block->plaintext, '-') !== false) {
                            $ex = explode('-', $block->plaintext)[1];  
                            $chapter = explode(' ', $ex)[1];
                          } else {*/
                            /*$ex3 = explode(' ', $block->plaintext);
                            $chapter = $ex3[count($ex3) - 1];*/
                          //}

                          
                        }

                      }
                      foreach($wrapperContent->find('.grab-content-chap') as $block) {
                        $content = $block->innertext;
                      }
                      
                        $newTag = Tag::updateOrCreate(
                          [ 'slug' => $this->urlSlug(strtolower($tag)) ],
                          [ 'name' => $tag, 'slug' => $this->urlSlug(strtolower($tag)) ]
                        );
                        

                        $categorySlug = $this->urlSlug('ngôn tình');

                        $newCategory = Category::updateOrCreate(
                          [ 'slug' => $categorySlug ],
                          [ 'name' => 'ngôn tình', 'slug' => $categorySlug ]
                        );

                        $newStory = Story::where('chapter', $chapter)->where('slug', $this->urlSlug($title))->where('number', $number)->first();
                        if(!$newStory) {
                          $newStory = new Story(
                            [
                              'chapter' => $chapter,
                              'title'   => $title,
                              'content' => htmlentities(trim($content)),
                              'slug'    => $this->urlSlug(strtolower($subtitle)),
                              'number'  => $number,
                              'subtitle' => $subtitle
                            ]
                          );
                          $newStory->categories()->associate($newCategory);
                          $newStory->tags()->associate($newTag);
                          
                          //$this->downloadFile();
                          
                          $newStory->save();
                        }
                    //}
                  }
              }
        }

    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {
      //
   }
   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store()
   {
      //
   }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function edit($id)
   {
      //
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
      //
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
      //
   }
   private function urlSlug($str) 
    {
      $str = trim(mb_strtolower($str));
      $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
      $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
      $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
      $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
      $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
      $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
      $str = preg_replace('/(đ)/', 'd', $str);
      $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
      $str = preg_replace('/([\s]+)/', '-', $str);
      return $str;
    }
}
