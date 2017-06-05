<?php


    class Livro {
    public $id;
    public $imagemCapa;
    public $titulo;
    public $pdf;
	public $idgenero;
	public $favoritos;
	

    public function __construct($id, $imagemCapa, $titulo, $pdf, $idgenero,$favoritos){
        $this->id = $id;
        $this->imagemCapa = $imagemCapa;
        $this->titulo = $titulo;
        $this->pdf = $pdf;
		$this->genero= $idgenero;
		$this->favoritos= $favoritos;
    }


   public static function all() {

        try {

            $list = [];
            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $req = $db->prepare('select * from tbllivro as l
                left join  tblfavoritos as f on l.id = f. idLivro and f.idUsuario ='.$_SESSION['idLogin']);
            $req->execute();

            // resultados do banco
            foreach($req->fetchAll() as $item) {
                $list[] = new Livro
                    ($item['id'],
                     $item['capa'],
                     $item['titulo'],
                     $item['pdf'],
					 $item['idgenero'],
					 $item['favoritos']
                    );
            }

            return $list;
        } catch (PDOException $e) {
            echo 'Connection failed: '.$e->getMessage();
        }
    }


    public static function buscar($query) {

        try {

            $list = [];
            $db = Db::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM tblLivro where titulo like '%". $query ."%';";
            $req = $db->prepare($sql);
            $req->execute();



            // resultados do banco
            foreach($req->fetchAll() as $item) {
                $list[] = new Livro
                    ($item['id'],
                     $item['capa'],
                     $item['titulo'],
                     $item['pdf'],
					 $item['idgenero']
					
                    );
            }

            return $list;
        } catch (PDOException $e) {
            echo 'Connection failed: '.$e->getMessage();
        }
    }
}
?>
