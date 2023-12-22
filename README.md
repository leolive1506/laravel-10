# Ignorar registro atual na validação
```php
"unique:table,field,{$this->id},id",
Rule::unique('table')->ignore($this->id)
```
