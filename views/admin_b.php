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
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
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
        <main role="main" class="col-10 ml-sm-auto px-4">                    
          <h2>Книги</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr align="center">
                  <th>Автор</th>                                    
                  <th>Название книги</th>
                  <th>Дата создания</th>
                </tr>
              </thead>
              <tbody>
                    <?php foreach($data as $item): ?>
                        <tr align="left">
                            <td><?=$item['first_name'].' '.(isset($item['patronymic']) && $item['patronymic'] != null ? $item['patronymic'].' ' : '').$item['last_name'];?></td>                            
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
