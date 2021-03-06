<?php
/**
 * MIT licence
 * Version 1.0.0
 * Sjaak Priester, Amsterdam 29-10-2015.
 *
 * Google Charts widget for Yii 2.0 framework
 * @link https://developers.google.com/chart/
 */

namespace sjaakp\gcharts;


class BarChart extends Chart    {

    public function init()  {
        parent::init();

        $dataTable = $this->dataTable();

        if ($this->mode != 'classic') $this->options['bars'] = 'horizontal';
        $jOpts = self::encode($this->options);

        $id = $this->getId();

        if ($this->mode == 'classic') {
            $package = 'corechart';
            $call = "var $id=new google.visualization.BarChart(document.getElementById('$id'));$id.draw($dataTable,$jOpts);";
        }
        else    {
            $package = 'bar';
            if ($this->mode == 'transition') $jOpts = "google.charts.Bar.convertOptions($jOpts)";
            $call = "var $id=new google.charts.Bar(document.getElementById('$id'));$id.draw($dataTable,$jOpts);";
        }
        $this->packages = [$package];

        $this->getView()->registerJs($call);
    }
}