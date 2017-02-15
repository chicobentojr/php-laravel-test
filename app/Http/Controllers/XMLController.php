<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Album;
use App\Track;
use SimpleXMLElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class XMLController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('xml.index');
    }

    public function download($type,$id)
    {
      if (in_array($type, ['artist', 'track', 'album']))
      {
        if ($type == 'artist') {
          $data = Artist::getFromAPI($id, false);
        }
        else if ($type == 'track') {
          $data = Track::getFromAPI($id, false);
        }
        else {
          $data = Album::getFromAPI($id, false);
        }

        $xml = new SimpleXMLElement('<'.$type.'/>');
        $xml = XMLController::array_to_xml($data->toArray(), $xml);

        $content = $xml->asXML();

        return response($content)
              ->withHeaders([
                'Cache-Control'=>'public',
                'Content-Description'=>'File Transfer',
                'Content-Disposition'=>'attachment; filename='.$data->name.'.xml',
                'Content-Transfer-Encoding'=>'binary',
                'Content-Type' => 'text/xml',
              ]);
      }

      return redirect()->route('xml');
    }

    public function upload(Request $request)
    {
      $path = $request->file('doc')->store('upload_files');
      $file = Storage::get($path);
      $xml = simplexml_load_string($file);
      $type = $xml->getName();
      $json = json_encode($xml);
      $array = json_decode($json, true);

      if (in_array($type, ['artist', 'track', 'album']))
      {
        return redirect()->route('save.'.$type, ['id'=>$array['id']]);
      }

      return redirect()->route('xml')->with('error', 'Error on uploading file!');
    }

    public static function array_to_xml(array $arr, SimpleXMLElement $xml)
    {
      foreach ($arr as $k => $v) {
          is_array($v)
              ? XMLController::array_to_xml($v, $xml->addChild($k))
              : $xml->addChild($k, $v);
      }
      return $xml;
    }
}
