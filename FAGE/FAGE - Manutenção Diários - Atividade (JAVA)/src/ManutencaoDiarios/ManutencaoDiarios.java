package ManutencaoDiarios;

import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Visualisacao.AlteraAtividadeController;
import ManutencaoDiarios.Visualisacao.MostraDisciplinasController;
import ManutencaoDiarios.Visualisacao.PainelInsereController;
import java.io.IOException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;

/**
 *
 * @author Felipe
 */
public class ManutencaoDiarios extends Application {
    
    private Stage palcoPrincipal;
    private AnchorPane telaBase;
    
    @Override
    public void start(Stage palcoPrincipal) {
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Manutenção Diários - Atividades");
        
        chamaMostraDisciplinas();
    }
    
    public void chamaLayoutInsere(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/PainelInsere.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            PainelInsereController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaMostraDisciplinas(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/MostraDisciplinas.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            MostraDisciplinasController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaAlteraAtividade(Atividade atividade){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/AlteraAtividade.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            AlteraAtividadeController controller = carregadorFXML.getController();
            controller.setAtividade(atividade);
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }
    
}
