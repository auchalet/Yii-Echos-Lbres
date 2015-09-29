<?php

namespace frontend\controllers;


/**
 * Classe non utilisée
 * Classe gérant les appels AJAX
 * Pour le moment AJAX est géré via PJAX, mais plus tard à remplacer avec cette classe
 * @author Auchalet
 *
 */
class AjaxController extends Controller
{
	/**
	 * Charge le bon fichier .js
	 */
	public function init() {
	    parent::init();
	 
	    $this->jsFile = '@app/views/' . $this->id . '/ajax.js';
	 
	    // Publish and register the required JS file
	    Yii::$app->assetManager->publish($this->jsFile);
	    $this->getView()->registerJsFile(
	        Yii::$app->assetManager->getPublishedUrl($this->jsFile),
	        ['yii\web\YiiAsset'] // depends
	    );
	}
    


}
