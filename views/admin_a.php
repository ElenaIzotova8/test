<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Авторы</title>

    <!-- Bootstrap core CSS -->
    <link href="inc/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
  </head>
  <body>    
    
    <div class="container-fluid">      
      <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="?page=a">                  
                  Авторы <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=b">                  
                  Книги 
                </a>
              </li>                          
            </ul>
          </div>
        </nav>
        <form method="post" action="?page=a" class="col-10 ml-sm-auto px-4">
            <div class="form-inline">
                <label class="col-form-label  m-3">Имя</label>
                <div>
                    <input type="text" class="form-control" name="first_name" value="<?=isset($author['first_name']) ? htmlentities($author['first_name']) : '';?>"/>
                </div>
                <label class="col-form-label m-3">Отчество (если есть)</label>
                <div>
                    <input type="text" class="form-control" name="patronymic" value="<?=isset($author['patronymic']) ? htmlentities($author['patronymic']) : '';?>" />
                </div>
                <label class="col-form-label m-3">Фамилия</label>
                <div>
                    <input type="text" class="form-control" name="last_name" value="<?=isset($author['last_name']) ? htmlentities($author['last_name']) : '';?>" />
                </div>
                <div>
                    <button name="<?=isset($author) ? 'save' : 'add';?>" value="<?=isset($author['id']) ? $author['id'] : '';?>" class="btn btn-success btn-block  m-3" type="submit"><?=isset($author) ? 'Сохранить' : 'Добавить';?> автора</button>
                </div>
            </div>
        </form>
        <main role="main" class="col-10 ml-sm-auto px-4">                    
          <h2>Авторы и количество книг</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr align="center">
                  <th class="w1" scope="col"></th>
                  <th class="w1" scope="col"></th>
                  <th>Автор</th>
                  <th>Дата создания</th>                  
                  <th>Количество книг</th>
                </tr>
              </thead>
              <tbody>
                    <?php foreach($data as $item): ?>
                        <tr align="left">
                            <td class="nowrap">
                                <a class="btn btn-primary btn-sm" href="?page=a&edit=<?=$item['id'];?>">
                                Редактировать
                                </a>                                
                            </td>
                            <td class="nowrap">                                
                                <a class="btn btn-danger btn-sm" href="?page=a&del=<?=$item['id'];?>">
                                Удалить
                                </a>
                            </td>
                            <td><?=$item['first_name'].' '.(isset($item['patronymic']) && $item['patronymic'] != null ? $item['patronymic'].' ' : '').$item['last_name'];?></td>
                            <td><?=$item['created'];?></td>
                            <td><?=$item['count'];?></td>
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
