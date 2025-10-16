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

class FileController extends Controller
{
    public function download(Request $request)
    {
        $phpWord = new PhpWord();
        $all = $request->all();
        $note = Note::where('id', $all['note_id'])->first();
        unset($all['_token']);
        unset($all['note_id']);
        $section = $phpWord->addSection();
        $names = ['go' => "Действуй", 'title' => 'Раздел', 'results' => 'Итоги'];
        foreach ($all as $item) {
            if ($item == "book") {
                $section->addText('Название',  ['bold' => true]);
                if (isset($note['book_id'])) {
                    $section->addText($note->book()->title);
                } else {
                    $section->addText($note->mybook);
                }
                $section->addTextBreak(1);
            } elseif ($item == "text") {
                $section->addText('Краткий конспект',  ['bold' => true]);
                Settings::setOutputEscapingEnabled(true);
                $doc = new DOMDocument();
                $doc->loadHTML($note[$item]);
                $doc->saveXml();
                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveXml(), true, false);
                $section->addTextBreak(1);
            } else {
                $section->addText($names[$item],  ['bold' => true]);
                $section->addText($note[$item]);
                $section->addTextBreak(1);

            }
        }
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
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
        $names = ['go' => "Действуй", 'title' => 'Раздел', 'results' => 'Итоги'];

        foreach($notes as $note) {
            $section = $phpWord->addSection();
            $section->addText('Дата создания',  ['bold' => true]);
            $section->addText($note->created_at);
            $section->addTextBreak(1);
            foreach ($all as $item) {
                if ($item == "book") {
                    $section->addText('Название',  ['bold' => true]);
                    if (isset($note['book_id'])) {
                        $section->addText($note->book()->title);
                    } else {
                        $section->addText($note->mybook);
                    }
                    $section->addTextBreak(1);
                } elseif ($item == "text") {
                    $section->addText('Краткий конспект',  ['bold' => true]);
                    Settings::setOutputEscapingEnabled(true);
                    $doc = new DOMDocument();
                    $doc->loadHTML($note[$item]);
                    $doc->saveXml();
                    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveXml(), true, false);
                    $section->addTextBreak(1);
                } else {
                    $section->addText($names[$item],  ['bold' => true]);
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
