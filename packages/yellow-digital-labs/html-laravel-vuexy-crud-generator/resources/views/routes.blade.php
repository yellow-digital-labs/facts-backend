/* Auto-generated admin routes */
Route::get('/{{ $resource }}/list', [App\Http\Controllers\Admin\{{ $controllerPartiallyFullName }}::class,
'list'])->name('{{ $resource }}-list');
Route::resource('/{{ $resource }}', App\Http\Controllers\Admin\{{ $controllerPartiallyFullName }}::class);