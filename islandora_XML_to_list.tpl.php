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
    print('<UL>');
    $element_attributes = array();
    $element_text = '';

    // Text node print.
    print ('<LI>');
      print ($XML_element->tagName . ':  ' . $XML_element->textContent);
    print ('</LI>');

    // Print attributes.
    if ($element_attributes) :
      foreach ($element_attributes as $attribute) :
        print ('<LI>');
          print ($attribute_name . ':  ' . $value);
        print ('</LI>');
      endforeach;
    endif;

    // If the current element has children send them through the print process.
    if($XML_element->hasChildNodes()) :
      foreach($XML_element->childNodes as $child_element) :
        print_XML_in_list($child_element);
      endforeach;
    endif;

    print('</UL>');
  }

  // Get root document and call into the recursive function.
  $datastream_DOM = DOMDocument::loadXML($XML_datastream);
  $XML_root_element = $datastream_DOM->documentElement;
  print_XML_in_list($XML_root_element);
?>
</div>
