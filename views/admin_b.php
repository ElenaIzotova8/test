<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Книги</title>

    <!-- Bootstrap core CSS -->
    <link href="inc/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
  </head>
  <body>    
    
    <div class="container-fluid">      
      <div class="row">
      <nav class="col-md-1 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="?page=a">                  
                  Авторы
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=b">                  
                  Книги <span class="sr-only">(current)</span>
                </a>
              </li>                          
            </ul>
          </div>
        </nav>
        <form method="post" action="?page=b" class="col-11 ml-sm-auto px-4">
            <div class="form-inline">
                <label class="col-form-label  m-3">Автор</label>
                <select name="author_id">
                <?php foreach($auth_list as $author) {
                    $sel = ($book['author_id'] == $author['id']) ? 'selected' : '';
                ?>                
                  <option <?=$sel;?> value="<?=$author['id'];?>"><?=$author['first_name'].' '.(isset($author['patronymic']) && $author['patronymic'] != null ? $author['patronymic'].' ' : '').$author['last_name'];?></option>                  
                <?php } ?>
                </select>
                <label class="col-form-label m-3">Название</label>
                <div>
                    <input type="text" class="form-control" name="name" value="<?=isset($book['name']) ? htmlentities($book['name']) : '';?>" />
                </div>                
                <div>
                    <button name="<?=isset($book) ? 'save' : 'add';?>" value="<?=isset($book['id']) ? $book['id'] : '';?>" class="btn btn-success btn-block  m-3" type="submit"><?=isset($book) ? 'Сохранить' : 'Добавить';?> книгу</button>
                </div>
            </div>
        </form>
        <main role="main" class="col-11 ml-sm-auto px-4">                    
          <h2>Список книг</h2>
          <form method="post" action="?page=b" class="px-4">
            <div class="form-inline">
                <label class="col-form-label  m-3">Название</label>
                <div>
                    <input type="text" class="form-control" name="name" />
                </div>
                <label class="col-form-label m-3">Фамилия автора</label>
                <div>
                    <input type="text" class="form-control" name="last_name" />
                </div>                
                <label class="col-form-label m-3">Дата создания от</label>
                <div>
                    <input type="date" class="form-control" name="date_start" />
                </div>
                <label class="col-form-label m-3">до</label>
                <div>
                    <input type="date" class="form-control" name="date_end" />
                </div>
                <div>
                    <button name="filtr" class="btn btn-primary btn-block  m-3" type="submit">Найти</button>
                </div>                
            </div>
          </form>          
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr align="center">
                  <th class="w1" scope="col"></th>
                  <th class="w1" scope="col"></th>
                  <th><a href="?page=b&ord=last_name<?=isset($order) && $desc !=' DESC' ? '&desc=1' : '';?>">Автор</a></th>                  
                  <th><a href="?page=b&ord=name<?=isset($order) && $desc !=' DESC' ? '&desc=1' : '';?>">Название</a></th>
                  <th><a href="?page=b&ord=created<?=isset($order) && $desc !=' DESC' ? '&desc=1' : '';?>">Дата создания</a></th>                  
                </tr>
              </thead>
              <tbody>
                    <?php foreach($data as $item): ?>
                        <tr align="left">
                            <td class="nowrap">
                                <a class="btn btn-primary btn-sm" href="?page=b&edit=<?=$item['id'];?>">
                                Редактировать
                                </a>                                
                            </td>
                            <td class="nowrap">                                
                                <a class="btn btn-danger btn-sm" href="?page=b&del=<?=$item['id'];?>">
                                Удалить
                                </a>
                            </td>
                            <td><?=$item['last_name'].' '.$item['first_name'].(isset($item['patronymic']) && $item['patronymic'] != null ? ' '.$item['patronymic'] : '');?></td>                            
                            <td><?=$item['name'];?></td>
                            <td><?=$item['created'];?></td>
                        </tr>
                    <?php endforeach; ?>
              </tbody>
            </table>
          </div>        
        </main>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>   

</body>
</html>

