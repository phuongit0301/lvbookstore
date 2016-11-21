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
      $this->gocTruyenCom();
    }

    public function gocTruyenCom()
    {
      $arr = [];
      //for($i = 1; $i < 19; $i++ ) {
        // xong a,b, c, d, e
        $parents = file_get_html('http://goctruyen.com/truyen-tien-hiep/');
        dd($parents);
        foreach($parents->find('h3[itemprop="name"]') as $parent) {
          foreach($parent->find('a') as $childs) {
            if(!in_array($childs->href, $arr)) {
              array_push($arr, $childs->href); 
            }
            
          }
        }
      //}
      dd($arr);
    }

    public function ifDownload()
    {
      /*$arr = [];
      for($i = 1; $i < 11; $i++ ) {
        // xong a,b, c, d, e
        $parents = file_get_html('http://gactruyen.com/tieu-thuyet-ngon-tinh/page/'.$i.'?first-letter=n');
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
    "http://gactruyen.com/tieu-thuyet/nu-quan-lan-chau.html",
"http://gactruyen.com/tieu-thuyet/neu-mua-ha-ay-em-khong-gap-anh.html",
"http://gactruyen.com/tieu-thuyet/nguoi-anh-yeu-chinh-la-em.html",
"http://gactruyen.com/tieu-thuyet/neu-nhu-chua-tung-gap-anh.html",
"http://gactruyen.com/tieu-thuyet/ngu-co-lua-chong.html",
"http://gactruyen.com/tieu-thuyet/nguoi-toi-khong-tot.html",
"http://gactruyen.com/tieu-thuyet/nhan-toi-voi-em.html",
"http://gactruyen.com/tieu-thuyet/nghich-duyen-tien-ma-ma-hau-la-thien-gioi-cong-chua.html",
"http://gactruyen.com/tieu-thuyet/nhoc-dau-vi-toi-u.html",
"http://gactruyen.com/tieu-thuyet/nguoc-ve-thoi-minh.html",
"http://gactruyen.com/tieu-thuyet/nghe-noi-nhan-duyen-troi-dinh.html",
"http://gactruyen.com/tieu-thuyet/ngoanh-lai-hoa-tro-tan.html",
"http://gactruyen.com/tieu-thuyet/nguyen-gia-thuong-cau.html",
"http://gactruyen.com/tieu-thuyet/nu-vuong-tro-ve-tong-giam-doc-cho-tron.html",
"http://gactruyen.com/tieu-thuyet/nguoi-binh-xuyen.html",
"http://gactruyen.com/tieu-thuyet/ngu-phon-hoa.html",
"http://gactruyen.com/tieu-thuyet/nguyet-ta-bich-sa-song.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-oi-di-nao.html",
"http://gactruyen.com/tieu-thuyet/nguyen-yeu-em-lan-nua-full.html",
"http://gactruyen.com/tieu-thuyet/nuoc-mat-thien-su.html",
"http://gactruyen.com/tieu-thuyet/nhap-nham-xac-yeu-dung-nguoi.html",
"http://gactruyen.com/tieu-thuyet/nua-kiep-hong-tran-mot-khuc-du-ca.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-truong-thanh-cua-bao-mau.html",
"http://gactruyen.com/tieu-thuyet/neu-tinh-yeu-chua-tung-noi-doi.html",
"http://gactruyen.com/tieu-thuyet/nuong-tu-vi-phu-bi-nguoi-bat-nat.html",
"http://gactruyen.com/tieu-thuyet/nam-thang-la-doa-hoa-hai-lan-no.html",
"http://gactruyen.com/tieu-thuyet/noi-khoi-nguon-hanh-phuc.html",
"http://gactruyen.com/tieu-thuyet/ngay-ket-hon-khong-nang.html",
"http://gactruyen.com/tieu-thuyet/nguoi-vi-thanh-nien.html",
"http://gactruyen.com/tieu-thuyet/nguoi-dep-ngu-luoi-bieng.html",
"http://gactruyen.com/tieu-thuyet/nhu-chua-tung-quen-biet.html",
"http://gactruyen.com/tieu-thuyet/neu-anh-noi-anh-yeu-em-full-lac-ha.html",
"http://gactruyen.com/tieu-thuyet/ngoc-oi-anh-yeu-em.html",
"http://gactruyen.com/tieu-thuyet/ngu-quen-duoi-gian-thien-ly.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-vo-chong-hai-hoa.html",
"http://gactruyen.com/tieu-thuyet/nha-co-su-tu-ha-dong-full.html",
"http://gactruyen.com/tieu-thuyet/nguoi-dan-ong-cua-toi.html",
"http://gactruyen.com/tieu-thuyet/ngan-lop-tuyet.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-cua-trieu-tich.html",
"http://gactruyen.com/tieu-thuyet/nhat-duoc-201-van.html",
"http://gactruyen.com/tieu-thuyet/nhim-con-em-dung-so.html",
"http://gactruyen.com/tieu-thuyet/nhat-trieu-hoa.html",
"http://gactruyen.com/tieu-thuyet/nam-thua-nu-thieu-dang.html",
"http://gactruyen.com/tieu-thuyet/no-em-mot-hanh-phuc.html",
"http://gactruyen.com/tieu-thuyet/nhat-thoi-xuc-dong-bay-kiep-khong-may.html",
"http://gactruyen.com/tieu-thuyet/ngoc-lau-xuan.html",
"http://gactruyen.com/tieu-thuyet/nu-vuong-da-man-cua-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/nguoi-vo-bi-mat.html",
"http://gactruyen.com/tieu-thuyet/nguoi-vo-o-rieng.html",
"http://gactruyen.com/tieu-thuyet/nguoi-dan-ong-xa-la.html",
"http://gactruyen.com/tieu-thuyet/nay-nhoc-em-la-vo-anh.html",
"http://gactruyen.com/tieu-thuyet/nhung-chang-trai-cua-man-dem.html",
"http://gactruyen.com/tieu-thuyet/nhat-kien-chung-tinh.html",
"http://gactruyen.com/tieu-thuyet/ngam-hoa-no-trong-suong.html",
"http://gactruyen.com/tieu-thuyet/nang-dau-trong-sinh.html",
"http://gactruyen.com/tieu-thuyet/nha-dau-kho.html",
"http://gactruyen.com/tieu-thuyet/nu-sat-thu-phuong-hoang.html",
"http://gactruyen.com/tieu-thuyet/nguc.html",
"http://gactruyen.com/tieu-thuyet/nguoi-phien-dich.html",
"http://gactruyen.com/tieu-thuyet/nghe-noi-chu-yeu-loli.html",
"http://gactruyen.com/tieu-thuyet/nuoi-duong-bao-vuong.html",
"http://gactruyen.com/tieu-thuyet/nguoi-lang-gieng-cua-anh-trang.html",
"http://gactruyen.com/tieu-thuyet/nhoc-toi-yeu-em-roi-day.html",
"http://gactruyen.com/tieu-thuyet/nuong-tu-dung-nghich-nua.html",
"http://gactruyen.com/tieu-thuyet/ngai-gi-yeu-nhau.html",
"http://gactruyen.com/tieu-thuyet/nam-vung-la-mot-ki-thuat.html",
"http://gactruyen.com/tieu-thuyet/nu-tac-trom-tim.html",
"http://gactruyen.com/tieu-thuyet/nguyet-da-tinh-linh.html",
"http://gactruyen.com/tieu-thuyet/nguyet-quang.html",
"http://gactruyen.com/tieu-thuyet/ngoc-toa-dao-dai.html",
"http://gactruyen.com/tieu-thuyet/ngao-tuyet-tran.html",
"http://gactruyen.com/tieu-thuyet/neu-anh-la-giot-le-noi-day-mat-em.html",
"http://gactruyen.com/tieu-thuyet/neu-co-duyen-song-lai.html",
"http://gactruyen.com/tieu-thuyet/nu-can-ba-dot-kich-vuong-gia-chay-mau.html",
"http://gactruyen.com/tieu-thuyet/nguoi-chong-mau-lanh.html",
"http://gactruyen.com/tieu-thuyet/nu-hon-cua-soi.html",
"http://gactruyen.com/tieu-thuyet/nhu-hoa-ky-that-khong-nhu-hoa.html",
"http://gactruyen.com/tieu-thuyet/nhat-ki-30-ngay-cua-nam-phu.html",
"http://gactruyen.com/tieu-thuyet/nguoi-chong-bi-vut-bo.html",
"http://gactruyen.com/tieu-thuyet/nhiet-ha.html",
"http://gactruyen.com/tieu-thuyet/nhu-hoa-nhu-suong-lai-nhu-gio.html",
"http://gactruyen.com/tieu-thuyet/nam-than-bien-thanh-cun.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-ngoc-nghech-cua-tong-giam-doc-full.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-vuot-tuong-cua-vo-yeu.html",
"http://gactruyen.com/tieu-thuyet/nu-vuong-khong-treu-noi.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-chay-tron-tinh-yeu-full.html",
"http://gactruyen.com/tieu-thuyet/noi-nao-ha-mat.html",
"http://gactruyen.com/tieu-thuyet/nu-vuong-hac-dao-ong-xa-cho-lam-loan.html",
"http://gactruyen.com/tieu-thuyet/nhat-ki-son-moi.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-xem-mat-chong-gia.html",
"http://gactruyen.com/tieu-thuyet/nu-hon-ngot-ngao.html",
"http://gactruyen.com/tieu-thuyet/nho-nhung-nguoi-xa-la.html",
"http://gactruyen.com/tieu-thuyet/nam-an-thai-phi-truyen-ky.html",
"http://gactruyen.com/tieu-thuyet/nhat-duoc-ong-xa-si-quan.html",
"http://gactruyen.com/tieu-thuyet/no-em-mot-doi-hanh-phuc.html",
"http://gactruyen.com/tieu-thuyet/ngoi-o-dau-tuong-cho-hong-hanh.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-hai-mat-cua-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/nghich-ngom-co-phi.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-bao-thu-cua-nu-phu.html",
"http://gactruyen.com/tieu-thuyet/nghe-lam-phi-tap-1.html",
"http://gactruyen.com/tieu-thuyet/neu-nhu-khong-tuoc-khong-xoe-duoi.html",
"http://gactruyen.com/tieu-thuyet/nguoi-moi-tuc-gian.html",
"http://gactruyen.com/tieu-thuyet/nhiem-vu-cuu-yeu.html",
"http://gactruyen.com/tieu-thuyet/nhi-gia-nha-ta.html",
"http://gactruyen.com/tieu-thuyet/nguoi-tinh-bi-mat-cua-tong-giam-doc-ac-ma.html",
"http://gactruyen.com/tieu-thuyet/nguoi-tinh-then-thung-cua-chu-tich.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-ngoc-nghech-cua-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/nguoi-tinh-nguy-hiem.html",
"http://gactruyen.com/tieu-thuyet/nguoi-ben-goi-lanh-lung.html",
"http://gactruyen.com/tieu-thuyet/neu-thoi-gian-co-ten.html",
"http://gactruyen.com/tieu-thuyet/neu-tinh-yeu-tro-thanh-niem-dau.html",
"http://gactruyen.com/tieu-thuyet/nghich-lua.html",
"http://gactruyen.com/tieu-thuyet/nga-re-di-ve-phia-anh-full.html",
"http://gactruyen.com/tieu-thuyet/nay-gio-bao-gio-anh-moi-tro-ve.html",
"http://gactruyen.com/tieu-thuyet/nhoc-con-em-chang-bao-gio-chiu-nghe-loi.html",
"http://gactruyen.com/tieu-thuyet/nang-osin-ca-tinh-va-chang-hotboy-lanh-lung.html",
"http://gactruyen.com/tieu-thuyet/nguoi-tinh-giau-mat.html",
"http://gactruyen.com/tieu-thuyet/nam-vung-quan-hon.html",
"http://gactruyen.com/tieu-thuyet/nu-nhan-ngoan-ngoan-ve-nha-voi-tram.html",
"http://gactruyen.com/tieu-thuyet/nu-phao-hoi-chinh-phuc-nam.html",
"http://gactruyen.com/tieu-thuyet/ngao-the-cuu-trong-thien.html",
"http://gactruyen.com/tieu-thuyet/nguyen-ky-nguyen-nhan.html",
"http://gactruyen.com/tieu-thuyet/nuong-chieu-bao-boi-no-le-tinh-yeu-cua-bao-vuong.html",
"http://gactruyen.com/tieu-thuyet/ngam-vinh-phong-ca.html",
"http://gactruyen.com/tieu-thuyet/ngu-phat.html",
"http://gactruyen.com/tieu-thuyet/ngoi-sao-lon-qua-cam-nho.html",
"http://gactruyen.com/tieu-thuyet/nhat-ky-tim-chong-cua-me-ho-do.html",
"http://gactruyen.com/tieu-thuyet/nghich-thien-doc-sung-cuong-phi-yeu-nghiet-full.html",
"http://gactruyen.com/tieu-thuyet/nuoc-chay-thanh-song.html",
"http://gactruyen.com/tieu-thuyet/ngot-ngao-dua-tinh.html",
"http://gactruyen.com/tieu-thuyet/nguyen-lay-chang-banh-bao.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-hoan.html",
"http://gactruyen.com/tieu-thuyet/neu-anh-chua-lay-vo-em-cung-chua-lay-chong.html",
"http://gactruyen.com/tieu-thuyet/nguoi-kia-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/ngai-chu-tich-ac-liet.html",
"http://gactruyen.com/tieu-thuyet/nguoi-tinh-tim-den-cua.html",
"http://gactruyen.com/tieu-thuyet/nhat-tuy-hua-phong-luu.html",
"http://gactruyen.com/tieu-thuyet/nu-nhan-huu-doc.html",
"http://gactruyen.com/tieu-thuyet/neu-oc-sen-co-tinh-yeu.html",
"http://gactruyen.com/tieu-thuyet/nho-ngoc-anh-yeu-em.html",
"http://gactruyen.com/tieu-thuyet/no-chong.html",
"http://gactruyen.com/tieu-thuyet/neu-khong-la-tinh-yeu.html",
"http://gactruyen.com/tieu-thuyet/no-nhau-mot-loi-hua.html",
"http://gactruyen.com/tieu-thuyet/ngu-ben-canh-giao-su.html",
"http://gactruyen.com/tieu-thuyet/neu-khong-phai-la-anh-full.html",
"http://gactruyen.com/tieu-thuyet/nguoi-yeu-dao-hoa-cua-toi.html",
"http://gactruyen.com/tieu-thuyet/nguoi-hau-kiem-thanh-van-thien-sung-ai.html",
"http://gactruyen.com/tieu-thuyet/ngot-ngao-voi-tong-giam-doc.html",
"http://gactruyen.com/tieu-thuyet/noi-dau-cung-thay-anh.html",
"http://gactruyen.com/tieu-thuyet/nguoc-thoi-gian.html",
"http://gactruyen.com/tieu-thuyet/ngan-nam-cho-doi.html",
"http://gactruyen.com/tieu-thuyet/nu-hon-cuong-nhiet.html",
"http://gactruyen.com/tieu-thuyet/nguoi-o-chung-cuong-ngao.html",
"http://gactruyen.com/tieu-thuyet/nu-nhi-lac-gia.html",
"http://gactruyen.com/tieu-thuyet/nam-ay-gap-duoc-anh.html",
"http://gactruyen.com/tieu-thuyet/nguyen-uoc-tron-doi.html",
"http://gactruyen.com/tieu-thuyet/nguoi-vo-thay-full-ngan-thien.html",
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

    public function arrayDownload()
    {
      $arr = [];
      for($i = 1; $i < 5; $i++ ) {
        //$parents = file_get_html('http://gactruyen.com/tieu-thuyet-ngon-tinh/page/'.$i.'?first-letter=c');
        //$parents = file_get_html('http://gactruyen.com/tieu-thuyet-ngon-tinh/page/'.$i.'?first-letter=f');
        $parents = file_get_html('http://gactruyen.com/tieu-thuyet-ngon-tinh/page/'.$i.'?first-letter=k');
        foreach($parents->find('.poster') as $parent) {
          foreach($parent->find('a') as $childs) {
            if(!in_array($childs->href, $arr)) {
              array_push($arr, $childs->href); 
            }
            
          }
        }
      }

      foreach(array_unique($arr) as $childs) {
        $html = file_get_html($childs);
             //$html = file_get_html('http://gactruyen.com/tieu-thuyet/nu-vuong-hac-dao-ong-xa-cho-lam-loan.html');
              foreach($html->find('.part1') as $index => $e) {
                  foreach($e->find('a') as $index => $elem) {
                    //if($index > 223) {
                        $link = $elem->href;

                    $wrapperContent = file_get_html($link);
                    $title = '';
                    $content = '';
                    $category = '';
                    $tag = '';
                    $number = 0;
                    $chapter = '';
                    $ex = '';

                      foreach($wrapperContent->find('.entry-title') as $block) {
                        $tag = $block->plaintext;
                      }

                      foreach($wrapperContent->find('.detailchapter') as $block) {
                        $title = $block->plaintext;
                        if(strrpos($title, '.') === true) {
                          $n = explode('.', $title)[1];
                          $number = explode(' ', $n)[0];
                        } else {
                          $n = explode(':', $title)[0];
                          $number = explode(' ', $n)[1];
                        }
                      }

                      foreach($wrapperContent->find('.entry-subtitle') as $block) {
                        \Log::info($link);
                        \Log::info($block->plaintext);
                        if(strrpos($block->plaintext, '.')) {
                          $ex1 = explode('.', $block->plaintext)[0];
                          $ex2 = explode(' ', $ex1);
                          $ex = (int) $ex2[count($ex2) - 1];
                          if(empty($title)) {
                            $title = explode('.', $block->plaintext)[1];
                          }
                          $chapter = $ex;
                        } else {
                          if(strpos($block->plaintext, '–') !== false) {
                            $ex = explode('–', $block->plaintext)[1];
                            $chapter = explode(' ', $ex)[1];
                          } else if(strpos($block->plaintext, '-') !== false) {
                            $ex = explode('-', $block->plaintext)[1];  
                            //dd($ex);
                            $chapter = explode(' ', $ex)[1];
                          } else {
                            $ex3 = explode(' ', $block->plaintext);
                            $chapter = $ex3[count($ex3) - 1];
                          }

                          if(empty($title)) {
                            $title = $ex;
                          }
                          
                        }

                      }

                      foreach($wrapperContent->find('.grab-content-chap') as $block) {
                        $content = $block->innertext;
                      }
                        $newTag = Tag::updateOrCreate(
                          [ 'slug' => $this->urlSlug($tag) ],
                          [ 'name' => $tag, 'slug' => $this->urlSlug($tag) ]
                        );
                        

                        $categorySlug = $this->urlSlug('ngôn tình');

                        $newCategory = Category::updateOrCreate(
                          [ 'slug' => $categorySlug ],
                          [ 'name' => 'ngôn tình', 'slug' => $categorySlug ]
                        );

                        $newStory = new Story(
                          [
                            'chapter' => $chapter,
                            'title'   => $title,
                            'content' => htmlentities(trim($content)),
                            'slug'    => $this->urlSlug($title),
                            'number'  => $number
                          ]
                        );
                        $newStory->categories()->associate($newCategory);
                        $newStory->tags()->associate($newTag);
                        
                        //$this->downloadFile();
                        
                        $newStory->save();
                   //}
                    
                  }
              }
      }
    }

    public function download()
    {
      for($i = 1; $i < 3; $i++ ) {
        $parents = file_get_html('http://gactruyen.com/tieu-thuyet-ngon-tinh/page/'.$i.'?first-letter=e');
        foreach($parents->find('.poster') as $parent) {
          foreach($parent->find('a') as $childs) {
             $html = file_get_html($childs->href);
             //$html = file_get_html('http://gactruyen.com/tieu-thuyet/nu-vuong-hac-dao-ong-xa-cho-lam-loan.html');
              foreach($html->find('.part1') as $index => $e) {
                  foreach($e->find('a') as $index => $elem) {
                    //if($index > 223) {
                        $link = $elem->href;

                    $wrapperContent = file_get_html($link);
                    $title = '';
                    $content = '';
                    $category = '';
                    $tag = '';
                    $number = 0;
                    $chapter = '';
                    $ex = '';

                      foreach($wrapperContent->find('.entry-title') as $block) {
                        $tag = $block->plaintext;
                      }

                      foreach($wrapperContent->find('.detailchapter') as $block) {
                        $title = $block->plaintext;
                        if(strrpos($title, '.') === true) {
                          $n = explode('.', $title)[1];
                          $number = explode(' ', $n)[0];
                        } else {
                          $n = explode(':', $title)[0];
                          $number = explode(' ', $n)[1];
                        }
                      }

                      foreach($wrapperContent->find('.entry-subtitle') as $block) {
                        \Log::info($link);
                        \Log::info($block->plaintext);
                        if(strrpos($block->plaintext, '.')) {
                          $ex1 = explode('.', $block->plaintext)[0];
                          $ex2 = explode(' ', $ex1);
                          $ex = (int) $ex2[count($ex2) - 1];
                          if(empty($title)) {
                            $title = explode('.', $block->plaintext)[1];
                          }
                          $chapter = $ex;
                        } else {
                          if(strpos($block->plaintext, '–') !== false) {
                            $ex = explode('–', $block->plaintext)[1];
                            $chapter = explode(' ', $ex)[1];
                          } else if(strpos($block->plaintext, '-') !== false) {
                            $ex = explode('-', $block->plaintext)[1];  
                            $chapter = explode(' ', $ex)[1];
                          } else {
                            $ex3 = explode(' ', $block->plaintext);
                            $chapter = $ex3[count($ex3) - 1];
                          }

                          if(empty($title)) {
                            $title = $ex;
                          }
                          
                        }

                      }

                      foreach($wrapperContent->find('.grab-content-chap') as $block) {
                        $content = $block->innertext;
                      }
                        $newTag = Tag::updateOrCreate(
                          [ 'slug' => $this->urlSlug($tag) ],
                          [ 'name' => $tag, 'slug' => $this->urlSlug($tag) ]
                        );
                        

                        $categorySlug = $this->urlSlug('ngôn tình');

                        $newCategory = Category::updateOrCreate(
                          [ 'slug' => $categorySlug ],
                          [ 'name' => 'ngôn tình', 'slug' => $categorySlug ]
                        );

                        $newStory = new Story(
                          [
                            'chapter' => $chapter,
                            'title'   => $title,
                            'content' => htmlentities(trim($content)),
                            'slug'    => $this->urlSlug($title),
                            'number'  => $number
                          ]
                        );
                        $newStory->categories()->associate($newCategory);
                        $newStory->tags()->associate($newTag);
                        
                        //$this->downloadFile();
                        
                        $newStory->save();
                   //}
                    
                  }
              }
          }
        }
      }
    }

    private function downloadFile($nameFileDownload, $nameFileServer)
    {
        try {
            $year = date('Y');
            $month = date('m');
            $resource = fopen(base_path() . '/public/images/{$year}/{$month}'.$nameFileDownload, 'w') or die('Problems');
            $stream = Psr7\stream_for($resource);
            $client = new Client();
            $request = $client->request('GET', $nameFileServer, ['save_to' => $stream]);
            return $request;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
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
