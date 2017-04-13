<?php
namespace Admin\Controller;
use Think\Controller;
class SourceController extends Controller {
    public function _initialize(){
       // $this->checkLogin();dd``
    }
    public function export() {
        $file = fopen('/tmp/ti_dan.log','a+');
        $str = "序号\t难易度\t题目\tA\tB\tC\tD\t正确答案\t解释\t科目\t章节\t省份\n";
        fwrite($file, $str);
        $offset = 0;
        $limit = 10000;
        $question = M('question')->where(array('question_type'=>1, 'is_del'=>0))->limit(0,100000)->select();
        foreach($question as $k=>$value) {
                $answer = M('question_stem')->where(array('question_id'=>$value['id']))->select();
                $a = '';
                $b = '';
                $c = '';
                $d = '';
                foreach($answer as $v) {
                        switch($v['sn']) {
                            case 1:
                                $a = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true = 'a';
                                }
                            break;
                            case 2:
                                $b = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true = 'b';
                                }
                            break;
                            case 3:
                                $c = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true = 'c';
                                }
                            break;
                            case 4:
                                $d = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true = 'd';
                                }
                            break;
                        }
                }
		$s = "{$k}\t{$value['level']}\t{$value['title']}\t{$a}\t{$b}\t{$c}\t{$d}\t{$is_true}\t{$value['explain']}\t{$value['category']}\t{$value['chapter']}\t{$value['province_id']}\n";
                fwrite($file, $s);
echo $k."\n";
        }
        fclose($file);
    }
    public function exportduo() {
        $file = fopen('/tmp/ti_duo.log','a+');
        $str = "序号\t难易度\t题目\tA\tB\tC\tD\tE\t正确答案\t解释\t科目\t章节\t省份\n";
        fwrite($file, $str);
        $offset = 0;
        $limit = 10000;
        $question = M('question')->where(array('question_type'=>2))->select();
        foreach($question as $k=>$value) {
                $answer = M('question_stem')->where(array('question_id'=>$value['id']))->select();
                $a = '';
                $b = '';
                $c = '';
                $d = '';
                $e = '';
                $is_true = '';
                foreach($answer as $v) {
                        switch($v['sn']) {
                            case 1:
                                $a = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true .= 'a,';
                                }
                            break;
                            case 2:
                                $b = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true .= 'b,';
                                }
                            break;
                            case 3:
                                $c = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true .= 'c,';
                                }
                            break;
                            case 4:
                                $d = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true .= 'd,';
                                }
                            break;
                            case 5:
                                $e = $v['stem_content'];
                                if ($v['is_true']) {
                                    $is_true .= 'e,';
                                }
                            break;
                        }
                }
                $is_true = trim($is_true,',');
		$s = "{$k}\t{$value['level']}\t{$value['title']}\t{$a}\t{$b}\t{$c}\t{$d}\t{$e}\t{$is_true}\t{$value['explain']}\t{$value['category']}\t{$value['chapter']}\t{$value['province_id']}\n";
                fwrite($file, $s);
		echo $k."\n";
        }
        fclose($file);
    }
}
