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
