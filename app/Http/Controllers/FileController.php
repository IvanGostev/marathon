<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\HTML;


//
//'<html>
//<head>
//<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
//</head>
//<body>
//<p><img src="https://bru-ch.com/upload/17592666260.png"></p>
//</body>
//</html>'

class FileController extends Controller
{
    protected array $names = ['book' => 'Название', 'title' => 'Раздел', 'text' => 'Краткий конспект', 'results' => 'Основные мысли', 'go' => "Апробируй"];


    public function download(Request $request)
    {
        $phpWord = new PhpWord();
        $all = $request->all();
        $note = Note::where('id', $all['note_id'])->first();
        unset($all['_token']);
        unset($all['note_id']);
        $section = $phpWord->addSection();

        foreach ($all as $item) {
            $section->addText($this->names[$item], ['bold' => true]);

            if ($item == "book") {
                if (isset($note['book_id'])) {
                    $section->addText($note->book()->title);
                } else {
                    $section->addText($note->mybook);
                }
                $section->addTextBreak(1);
            } elseif ($item == "text" or $item == "results" or $item == "go") {
                Settings::setOutputEscapingEnabled(true);
                $doc = new DOMDocument();
                $doc->loadHTML($note[$item]);

                // Edit src and style for images
                $tags = $doc->getElementsByTagName('img');
                if (count($tags) > 0) {
                    foreach ($tags as $tag) {
                        $tag->setAttribute('src', asset($tag->getAttribute('src')));
                        $styles = explode(':', str_replace(';', ':', $tag->getAttribute('style')));
                        for ($i = 0; $i < count($styles); $i++) {
                            if ($styles[$i] == 'width') {
                                $tag->setAttribute('width', $styles[$i+1]);
                            }  else if ($styles[$i] == 'height') {
                                $tag->setAttribute('height', $styles[$i+1]);
                            }
                        }
                    }
//
                }


                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveXml(), true);
                $section->addTextBreak(1);
            } else {
                $section->addText($note[$item]);
                $section->addTextBreak(1);

            }
        }
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007', true);
        $name = Str::slug('Report for ' . $note->created_at . ' from ' . $note->user()->name) . '.docx';
        try {
            $objWriter->save(storage_path($name));
        } catch (Exception $e) {
            return response('Error ' . $e->getMessage());
        }
        return response()->download(storage_path($name));
    }

    public function all(Request $request)
    {
        $phpWord = new PhpWord();
        $all = $request->all();
        unset($all['_token']);

        $daterange = $all['daterange'];
        $arrDate = explode(' - ', $daterange);
        $start = Carbon::parse($arrDate[0]);
        $finish = Carbon::parse($arrDate[1])->addDay();
        unset($all['daterange']);

        $notes = Note::where('user_id', auth()->user()->id)->whereBetween('created_at', [$start, $finish])->get();


        foreach ($notes as $note) {
            $section = $phpWord->addSection();
            $section->addText('Дата создания', ['bold' => true]);
            $section->addText($note->created_at);
            $section->addTextBreak(1);
            foreach ($all as $item) {
                $section->addText($this->names[$item], ['bold' => true]);

                if ($item == "book") {
                    if (isset($note['book_id'])) {
                        $section->addText($note->book()->title);
                    } else {
                        $section->addText($note->mybook);
                    }
                    $section->addTextBreak(1);
                }elseif ($item == "text" or $item == "results" or $item == "go") {
                    Settings::setOutputEscapingEnabled(true);
                    $doc = new DOMDocument();
                    $doc->loadHTML($note[$item]);

                    // Edit src and style for images
                    $tags = $doc->getElementsByTagName('img');
                    if (count($tags) > 0) {
                        foreach ($tags as $tag) {
                            $tag->setAttribute('src', asset($tag->getAttribute('src')));
                            $styles = explode(':', str_replace(';', ':', $tag->getAttribute('style')));
                            for ($i = 0; $i < count($styles); $i++) {
                                if ($styles[$i] == 'width') {
                                    $tag->setAttribute('width', $styles[$i+1]);
                                }  else if ($styles[$i] == 'height') {
                                    $tag->setAttribute('height', $styles[$i+1]);
                                }
                            }
                        }
//
                    }


                    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveXml(), true);
                    $section->addTextBreak(1);
                }else {
                    $section->addText($note[$item]);
                    $section->addTextBreak(1);
                }
            }
        }

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $name = Str::slug('Report for ' . $daterange) . '.docx';
        try {
            $objWriter->save(storage_path($name));
        } catch (Exception $e) {
            return response('Error ' . $e->getMessage());
        }
        return response()->download(storage_path($name));
    }
}
