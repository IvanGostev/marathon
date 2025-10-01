<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\HTML;

class FileController extends Controller
{
    public function download(Note $note)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $invoice = $note->text;
        Html::addHtml($section, $invoice);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $name = Str::slug('Report for ' . $note->created_at . ' from ' . $note->user()->name) . '.docx';
        try {
            $objWriter->save(storage_path($name));
        } catch (Exception $e) {
            return response('Error ' . $e->getMessage());
        }
        return response()->download(storage_path($name));
    }

    public function all(User $user)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $notes = Note::where('user_id', $user->id)->get();
        $note_title = '';
        foreach ($notes as $note) {
            $section = $phpWord->addSection();
            $section->addText('ghbftn');
            $note_title += $note->title;
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, $note_title);
        $name = 'file.docx';

        $objWriter->save(storage_path($name));
        return response()->download(storage_path($name));

    }
}
