<?php

trait Config_Store
{
  public function storeApplyConfig($data)
  {
    if(isset($data['engine']) && isset($data[$data['engine']]))
    {
      if(method_exists($this, '_' . $data['engine'] . 'StoreEngine'))
        $this->{'_' . $data['engine'] . 'StoreEngine'}($data[$data['engine']]);
    }
  }
  
  protected function _fileStoreEngine($data)
  {
    $this->recordsFile = isset($data['name']) ? $data['name'] : 'records.json';
  }
}
