<?php

/**
 * Gallery page for holding the gallery
 */
class GalleryPage extends Page {

  public static $has_many = array(
    'Images' => 'GalleryPage_Image'
  );

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    
    $fields->addFieldToTab('Root.Gallery', GridField::create(
      'Images', 
      'Images', 
      $this->Images(), 
      GalleryPage_GridFieldConfig::create()
    ));

    return $fields;
  }
}

/**
 * Gallery page controller for loading javascript
 */
class GalleryPage_Controller extends Page_Controller {

  public function init() {

    parent::init();

    Requirements::javascript('gallery/javascript/jquery-1.7.1.min.js');
    Requirements::javascript('gallery/javascript/jquery.fancybox.js');

    Requirements::css('gallery/css/jquery.fancybox.css');
  }
}

/**
 * DataObject that represents each gallery "item"
 */
class GalleryPage_Image extends DataObject {

  public static $plural_name = 'Gallery Images';
  public static $singular_name = 'Gallery Image';

  static $db = array (
    'Caption' => 'Text',
    'SortOrder' => 'Int'
  );

  static $has_one = array (
    'Image' => 'Image',
    'GalleryPage' => 'GalleryPage'
  );

  static $summary_fields = array(
    'SummaryOfImage' => 'Image',
    'Caption' => 'Caption'
  );

  public static $default_sort = 'SortOrder';

  public function SummaryOfImage() {
    if ($Image = $this->Image()) return $Image->CMSThumbnail();
    else return '(No Image)';
  }

  public function getCMSFields() {
    $fields = parent::getCMSFields();

    $fields->removeByName('SortOrder');
    $fields->replaceField('GalleryPageID', new HiddenField('GalleryPageID'));

    return $fields;
  }
}

/**
 * Grid field config to customise detail form etc.
 */
class GalleryPage_GridFieldConfig extends GridFieldConfig {

  /**
   *
   * @param int $itemsPerPage - How many items per page should show up
   */
  public function __construct($itemsPerPage=null) {

    $this->addComponent(new GridFieldButtonRow('before'));
    $this->addComponent(new GridFieldAddNewButton('buttons-before-left'));
    $this->addComponent(new GridFieldToolbarHeader());
    $this->addComponent($sort = new GridFieldSortableHeader());
    $this->addComponent(new GridFieldDataColumns());
    $this->addComponent(new GridFieldEditButton());
    $this->addComponent(new GridFieldDeleteAction());
    $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

    $detailForm = new GalleryPage_GridFieldDetailForm();
    $detailForm->setItemRequestClass('GalleryPage_GridFieldDetailForm_ItemRequest');
    $this->addComponent($detailForm);

    if (class_exists('GridFieldSortableRows')) {
      $this->addComponent(new GridFieldSortableRows('SortOrder'));
    }

    $sort->setThrowExceptionOnBadDataType(false);
    $pagination->setThrowExceptionOnBadDataType(false);
  }
}

/**
 * Detail form to save the record when first created before editing, allowing images 
 * to be attached to the gallery item immediately.
 */
class GalleryPage_GridFieldDetailForm extends GridFieldDetailForm {

  public function handleItem($gridField, $request) {
    $controller = $gridField->getForm()->Controller();

    if(is_numeric($request->param('ID'))) {
      $record = $gridField->getList()->byId($request->param("ID"));
    } 
    else if (is_numeric($request->latestParam('ID'))) {
      $record = $gridField->getList()->byId($request->latestParam("ID"));
    }
    else {
      $record = Object::create($gridField->getModelClass()); 
      $record->write();
      $gridField->setList($gridField->getList()->add($record));
    }

    $class = $this->getItemRequestClass();

    $handler = Object::create($class, $gridField, $this, $record, $controller, $this->name);
    $handler->setTemplate($this->template);

    return $handler->handleRequest($request, DataModel::inst());
  }
}

/**
 * Simply to manage the return URL from the doDelete() action, unnecessary once this pull request is accepted:
 * https://github.com/silverstripe/sapphire/pull/852
 * http://open.silverstripe.org/ticket/7927
 */
class GalleryPage_GridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

  public function ItemEditForm() {

    if (empty($this->record)) {
      $controller = Controller::curr();
      $noActionURL = $controller->removeAction($_REQUEST['url']);
      $controller->getResponse()->removeHeader('Location');   //clear the existing redirect
      return $controller->redirect($noActionURL, 302);
    }

    $actions = new FieldList();
    if($this->record->ID !== 0) {
      $actions->push(FormAction::create('doSave', _t('GridFieldDetailForm.Save', 'Save'))
        ->setUseButtonTag(true)
        ->addExtraClass('ss-ui-action-constructive')
        ->setAttribute('data-icon', 'accept'));

      $actions->push(FormAction::create('doDelete', _t('GridFieldDetailForm.Delete', 'Delete'))
        ->addExtraClass('ss-ui-action-destructive'));

    }
    else { // adding new record
      //Change the Save label to 'Create'
      $actions->push(FormAction::create('doSave', _t('GridFieldDetailForm.Create', 'Create'))
        ->setUseButtonTag(true)
        ->addExtraClass('ss-ui-action-constructive')
        ->setAttribute('data-icon', 'add'));
        
      // Add a Cancel link which is a button-like link and link back to one level up.
      $crumbs = $this->Breadcrumbs();

      if ($crumbs && $crumbs->count()>=2) {
        $one_level_up = $crumbs->offsetGet($crumbs->count()-2);
        $text = sprintf(
          "<a class=\"%s\" href=\"%s\">%s</a>",
          "crumb ss-ui-button ss-ui-action-destructive cms-panel-link ui-corner-all", // CSS classes
          $one_level_up->Link, // url
          _t('GridFieldDetailForm.CancelBtn', 'Cancel') // label
        );
        $actions->push(new LiteralField('cancelbutton', $text));
      }
    }

    $form = new Form(
      $this,
      'ItemEditForm',
      $this->record->getCMSFields(),
      $actions,
      $this->component->getValidator()
    );
    if($this->record->ID !== 0) {
      $form->loadDataFrom($this->record);
    }

    // TODO Coupling with CMS
    $toplevelController = $this->getToplevelController();
    if($toplevelController && $toplevelController instanceof LeftAndMain) {
      // Always show with base template (full width, no other panels), 
      // regardless of overloaded CMS controller templates.
      // TODO Allow customization, e.g. to display an edit form alongside a search form from the CMS controller
      $form->setTemplate('LeftAndMain_EditForm');
      $form->addExtraClass('cms-content cms-edit-form center');
      $form->setAttribute('data-pjax-fragment', 'CurrentForm Content');
      if($form->Fields()->hasTabset()) {
        $form->Fields()->findOrMakeTab('Root')->setTemplate('CMSTabSet');
        $form->addExtraClass('ss-tabset cms-tabset');
      }

      $form->Backlink = $this->getBackLink();
    }

    $cb = $this->component->getItemEditFormCallback();
    if($cb) $cb($form, $this);

    return $form;
  }

  public function doDelete($data, $form) {

    try {

      $toDelete = $this->record;
      if (!$toDelete->canDelete()) {
        throw new ValidationException(
          _t('GridFieldDetailForm.DeletePermissionsFailure',"No delete permissions"),0);
      }
      $toDelete->delete();

    } catch(ValidationException $e) {
      $form->sessionMessage($e->getResult()->message(), 'bad');
      return Controller::curr()->redirectBack();
    }

    $toplevelController = $this->getToplevelController();
    if($toplevelController && $toplevelController instanceof LeftAndMain) {
      $backForm = $toplevelController->getEditForm();

      $message = sprintf(
        _t('GridFieldDetailForm.Deleted', 'Deleted %s %s'),
        $this->record->singular_name(),
        ''
      );

      $backForm->sessionMessage($message, 'good');
    }

    //when an item is deleted, redirect to the revelant admin section without the action parameter
    $controller = Controller::curr();
    $controller->getRequest()->addHeader('X-Pjax', 'Content'); // Force a content refresh
    return $controller->redirect($this->getBacklink(), 302); //redirect back to admin section
  }

  protected function getBackLink(){
    // TODO Coupling with CMS
    $backlink = '';
    $toplevelController = $this->getToplevelController();
    if($toplevelController && $toplevelController instanceof LeftAndMain) {
      if($toplevelController->hasMethod('Backlink')) {
        $backlink = $toplevelController->Backlink();
      } elseif($this->popupController->hasMethod('Breadcrumbs')) {
        $parents = $this->popupController->Breadcrumbs(false)->items;
        $backlink = array_pop($parents)->Link;
      } else {
        $backlink = $toplevelController->Link();
      }
    }
    return $backlink;
  }
}
