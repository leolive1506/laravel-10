# Ignorar registro atual na validação
```php
"unique:table,field,{$this->id},id",
Rule::unique('table')->ignore($this->id)
```

# Padão presenter
- req -> controller -> resultado termina em um presenter
- presenters -> view model
    - escolher o formato a ser exibido
    - transformação dado campos e tipos do arquivo  (Ex: json -> xml)

# Personalizar paginção
- executa comando abaixo escolher arquivo a ser usado de base
```sh
php artisan vendor:publish --tag=laravel-pagination
```
