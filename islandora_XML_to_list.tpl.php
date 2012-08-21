<?php
/**
 * @file
 *   This file is the template to show list containing XML data.
 *
 * @param array XML_data
 */

?>
<div class="islandora_XML_to_list_viewer">
<?php
  /**
   * recursive function that prints an
   * XML element to an unordered list
   *
   * @param mixed $XML_element
   *   An XML element to render in a list
   */
  function print_XML_in_list($XML_element) {

    // Text node print.
    print ('<LI>');
    print ($XML_element->tagName . ':  ' . $XML_element->nodeValue);


    // Print attributes.
    if (!empty($XML_element->attributes)):
      print('<UL>');
      foreach ($XML_element->attributes as $attribute) :
        print ('<LI>');
        print ('<STRONG>' . $attribute->name . '</STRONG> :  ' . $attribute->value);
        print ('</LI>');
      endforeach;
      print ('</UL>');
    endif;
    // If the current element has children send them through the print process.
    if($XML_element->hasChildNodes()) :
      foreach($XML_element->childNodes as $child_element) :
        if ($child_element->nodeType != XML_TEXT_NODE):
          print_XML_in_list($child_element);
        endif;
      endforeach;
    endif;

    print ('</LI>');
  }

  // Get root document and call into the recursive function.
  $datastream_DOM = DOMDocument::loadXML($XML_datastream);
  $XML_root_element = $datastream_DOM->documentElement;

  print('<UL>');
  print_XML_in_list($XML_root_element);
  print('</UL>');
?>
</div>
