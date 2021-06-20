<?php
/*
Plugin Name: oswp-partner
Plugin URI:        https://github.com/BigManzai/oswp-partner
Description: Insert Partnering in OpenSim.
Version:           1.1.1
Author:            Manfred Aabye
Author URI:        http://openmanniland.de
License: GPLv2 or later
*/
add_action('wp_dashboard_setup', array('oswp_partnerwidget','init') );

class oswp_partnerwidget {

    /**
     * Die ID dieses Widgets.
     */
    const wid = 'oswp_partnerwidget';

    /**
     * Hake an wp_dashboard_setup an, um dieses Widget hinzuzufügen.
     */
    public static function init() {
        // Widget-Einstellungen registrieren ...
        self::update_oswp_partnerwidget_options(
            self::wid,                                  			// Die Widget-ID
            array(                                      			// Array von Optionen und Standardwerten
                'oswp_example_number' => 42,
            ),
            true                                        			// Nur hinzufügen (vorhandene Optionen werden nicht aktualisiert)
        );

        //Register the widget...
        wp_add_dashboard_widget(
            self::wid,                                 		 		// Eine eindeutige slug/ID
            __( 'oswp partner widget', 'nouveau' ),				// Sichtbarer Name für das Widget
            array('oswp_partnerwidget','widget'),      		// Rückruf für den Hauptinhalt des Widgets
            array('oswp_partnerwidget','config')       		// Optionaler Rückruf für Widget-Konfigurationsinhalte
        );
    }

    /**
     * Lade den Widget-Code
     */
    public static function widget() {
        require_once( 'oswp-partner-widget.php' );
    }

    /**
     * Lade den Widget-Konfigurationscode.
     *
     * Dies wird angezeigt, wenn ein Administrator drauf klickt
     */
/*     public static function config() {
        require_once( 'widget-config.php' );
    } */

    /**
     * Ruft die Optionen für ein Widget mit dem angegebenen Namen ab.
     *
	 * @param string $ widget_id Optional.  Wenn angegeben, werden nur Optionen für das angegebene Widget abgerufen.
     * @return array Ein assoziatives Array, das die Optionen und Werte des Widgets enthält.  Falsch, wenn nicht anders angegeben.
	 */
    public static function get_dashboard_widget_options( $widget_id='' )
    {
        // ALLE Dashboard Widget Optionen aus der Datenbank abrufen ...
        $opts = get_option( 'oswp_partnerwidget_options' );

        // Wenn kein Widget angegeben ist, wird alles zurückgegeben
        if ( empty( $widget_id ) )
            return $opts;

        // Wenn wir ein Widget anfordern und es existiert, geben Sie es zurück
        if ( isset( $opts[$widget_id] ) )
            return $opts[$widget_id];

        // Etwas ist schief gelaufen...
        return false;
    }

	  /**
      * Ruft eine bestimmte Option für das angegebene Widget ab.
      * @param $widget_id
      * @param $Option
      * @param null $default
      *
      * @return string
      */
    public static function get_oswp_partnerwidget_option( $widget_id, $option, $default=NULL ) {

        $opts = self::get_oswp_partnerwidget_options($widget_id);

        // Wenn Widget Optionen nicht vorhanden sind, wird false zurückgegeben
        if ( ! $opts )
            return false;

        // Ansonsten die Option holen oder default verwenden
        if ( isset( $opts[$option] ) && ! empty($opts[$option]) )
            return $opts[$option];
        else
            return ( isset($default) ) ? $default : false;

    }

     /**
      * Speichert eine Reihe von Optionen für ein einzelnes Dashboard-Widget in der Datenbank.
      * Kann auch verwendet werden, um Standardwerte für ein Widget zu definieren.
      *
      * @param string $ widget_id Der Name des zu aktualisierenden Widgets
      * @param array $ args Ein assoziatives Array von Optionen, die gespeichert werden.
      * @param bool $ add_only Wenn true, werden Optionen nicht hinzugefügt, wenn bereits Widget-Optionen vorhanden sind.
      */
    public static function update_oswp_partnerwidget_options( $widget_id , $args=array(), $add_only=false )
    {
        // ALLE Dashboard Widget Optionen aus der Datenbank abrufen ...
        $opts = get_option( 'oswp_partnerwidget_options' );

        // Holen Sie sich nur die Optionen unseres Widgets oder setzen Sie ein leeres Array.
        $w_opts = ( isset( $opts[$widget_id] ) ) ? $opts[$widget_id] : array();

        if ( $add_only ) {
            // Verfeinere fehlende Optionen (bestehende überschreiben neue).
            $opts[$widget_id] = array_merge($args,$w_opts);
        }
        else {
            // Neue Optionen mit vorhandenen zusammenführen und wieder zum Widgets-Array hinzufügen.
            $opts[$widget_id] = array_merge($w_opts,$args);
        }

        // Speichere das gesamte Widgets-Array zurück in die Datenbank
        return update_option('oswp_partnerwidget_options', $opts);
    }

}