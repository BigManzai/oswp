<?php
/**
 * Diese Datei kann verwendet werden, um gesendete Formulardaten abzufangen.  Bei Verwendung einer Nichtkonfiguration
 * Ansicht zum Speichern von Formulardaten. Denken Sie daran, ein Identifikationsfeld in Ihrem Formular zu verwenden.
 */
    $number = ( isset( $_POST['number'] ) ) ? stripslashes( $_POST['number'] ) : '';
    self::update_dashboard_widget_options(
            self::wid,                                  //The  widget id
            array(                                      //Associative array of options & default values
                'example_number' => $number,
            )
    );

?>
<p>Dies ist ein Beispiel für ein Dashboard-Widget!</p>
<p>Dies ist der Konfigurationsteil des Widgets, der gefunden und bearbeitet werden kann unter <tt><?php echo __FILE__ ?></tt></p>
<input type="text" name="number" />