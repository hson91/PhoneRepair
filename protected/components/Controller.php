<?php
class Controller extends CController
{
	public $layout='main';
    public $configs = array();
    public $breadcrumbs;
    public $seo_keywords;
    public $seo_description;
    public $active = null;
    public $is_hone = false;
    public $guestLogin = null;
    public function init() {
        parent::init();
        if(Yii::app()->session['guestLogin']){
            $this->guestLogin = Yii::app()->session['guestLogin'];
        }
        $this->configs = Configs::getConfigs();
    }
    
    protected function beforeRender($view) {
        /*
        $seoUrl = SeoUrls::model()->find('url = :url', array(':url'=>Yii::app()->request->url));
        if($seoUrl){
            if($seoUrl->seo_title != ''){
                $this->pageTitle = $seoUrl->seo_title;
            }
            if($seoUrl->seo_keywords != ''){
                $this->seo_keywords = $seoUrl->seo_keywords;
            }
            if($seoUrl->seo_description != ''){
                $this->seo_description = $seoUrl->seo_description;
            }
        }
        if (empty($this->seo_description)){
            $this->seo_description = Configs::getConfig('seo-description-default');
        }
        if (empty($this->seo_keywords))
        {
            $this->seo_keywords = Configs::getConfig('seo-keyword-default');
        }
        Yii::app()->clientScript->registerMetaTag($this->seo_description, 'description');
        Yii::app()->clientScript->registerMetaTag($this->seo_keywords, 'keywords');
        */
        return true;
    }

    protected function afterRender($view, &$output) {
        parent::afterRender($view,$output);
        return true;
    }
}