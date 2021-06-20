<?php

namespace App\Controller;

use App\Entity\Devoire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\User;
use App\Repository\UserRepository;
use App\Form\Kids;
use App\Repository\KidsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MediaObject;
use App\Repository\MediaObjectRepository;
use App\Entity\Post;
use App\Event\CommentCreatedEvent;
use App\Form\CommentType;
use App\Repository\DevoireRepository;
use App\Repository\MatiereRepository;
use App\Repository\PostRepository;
use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/APIUser")
 */

class APIUserController extends AbstractController
{
    /**
     * @Route("/a/p/i/user", name="a_p_i_user")
     */
    public function index(): Response
    {
        return $this->render('api_user/index.html.twig', [
            'controller_name' => 'APIUserController',
        ]);
    }
    // "id": 1,
    // "Nom": "string",
    // "Prenom": "string",
    // "photo": "string",
    // "date_naissance": "2021-02-02T11:39:18+01:00",
    // "create_at": "2021-02-02T11:39:18+01:00",
    // "Update_at": "2021-02-02T11:39:18+01:00",
    // "Users": "/api/users/10",
    // "Password": "",

    //   /**
    //  * @Route("/{id}", name="GetKidsss")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function GetssKids(Request $request,KidsRepository $KidsRapository,UserRepository $UserRapository,$id): Response 
    // {
    //     $user=$UserRapository->findOneBy(['id' => $id]);
    //     $kids=$KidsRapository->getKids($user);

    //     $data = [];


    //       foreach ($kids as $kid) {
    //          $data[] = [
    //              'id'=>$kid->getId(),
    //             'Nom'=>$kid->getNom(),
    //            'Prenom'=>$kid->getPrenom(),
    //             'photo'=>$kid->getPhoto(),
    //             'date_naissance'=>$kid->getDateNaissance(),
    //             'Password'=>$kid->getPassword(),
    //             'gender'=>$kid->getGender(),
    //             'Timer'=>$kid->getTimer(),
                 
    //           ];
    //    }
    //     $response = new Response(json_encode($data));
    //     $response->headers->set('Content-Type', 'application/json');
    
    //     return $response;
    // }
 
    //    /**
    //  * @Route("/test/{id}/{cat}", name="GetVideoss")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function GetVideoss(Request $request,KidsRepository $KidsRapository,CategoryRepository $CategoryRepository,VideosRepository $VideosRepository,$cat,$id): Response 
    // {
    //     $Category=$CategoryRepository->findOneBy(['id' => $id]);
    //     $kids=$KidsRapository->findOneBy(['id' => $cat]);
    //     $Videos=$VideosRepository->getAllCategories($Category,$kids);

    //     $data = [];

        
    //       foreach ($Videos as $Video) {
    //          $data[] = [
    //              'id'=>$Video->getId(),
    //             'videoId'=>$Video->getVideoId(),
    //            'onReady'=>$Video->getOnReady(),
    //             'onChangeState'=>$Video->getOnChangeState(),
    //             'onChangeQuality'=>$Video->getOnChangeQuality(),
    //             'onError'=>$Video->getOnError(),
    //             'style'=>$Video->getStyle(),
    //             'ChannelName'=>$Video->getChannelName(),
    //             'Title'=>$Video->getTitle(),
    //             'Description'=>$Video->getDescription(),
    //           ];
    //    }
    //     $response = new Response(json_encode($data));
    //     $response->headers->set('Content-Type', 'application/json');
    
    //     return $response;
    // }

 
    //    /**
    //  * @Route("/User}", name="GetVideoss")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function GetUser(UserRepository $UserRapository): Response 
    // {
    //   $user = $this->getUser();
    //  // $user=$UserRapository->findOneBy(['id' => $id]);
    //     $data = [];

        
     
    //          $data[] = [
    //              'id'=>$user->getId(),
    //           ];
      
    //     $response = new Response(json_encode($data));
    //     $response->headers->set('Content-Type', 'application/json');
    
    //     return $response;
    // }


 /**
     * @Route("/login/{username}", name="getlogin")
     * @Method("GET")
     * @Template()
     */
    public function getlogin($username,UserRepository $UserRapository): Response 
    {
        $user=$UserRapository->findOneBy(['username' => $username]);
        

        $data = [];


          
             $data[] = [
                 'id'=>$user->getId(),
                 
              ];
      
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
    
        return $response;
    }

    /**
     * @Route("/User/{id}", name="getUserById")
     * @Method("GET")
     * @Template()
     */
    public function getUserById($id,MediaObjectRepository $MediaObjectRepository,UserRepository $UserRapository): Response 
    {
        $user=$UserRapository->findOneBy(['id' => $id]);
        $MediaObjects=$MediaObjectRepository->findBy(['Id_media' => $user]);

        $data = [];


          
             $data[] = [
                 'id'=>$user->getId(),
                 'fullName'=>$user->getFullName(),
                 'username'=>$user->getUsername(),
                 'email'=>$user->getEmail(),
                 'Genre'=>$user->getGenre(),
                 'date_naissance'=>$user->getDateNaissance(),
                 'Nationalite'=>$user->getNationalite(),
                 'phone'=>$user->getPhone(),
               
               
              ];
              foreach ($MediaObjects as $MediaObject) {
                    $photo="http://www.pointofsaleseedigitalaency.xyz/public/media/".$MediaObject->getfilePath();

                $data[] = [
                    'type'=>$MediaObject->getType(),
                    'photo'=> $photo,
                  
                 ];

              }
       
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
    
        return $response;
    }


    /**
     * @Route("/Student/{id}", name="getStudentById")
     * @Method("GET")
     * @Template()
     */
    public function getStudentById($id,MediaObjectRepository $MediaObjectRepository,UserRepository $UserRapository,MatiereRepository $MatiereRepository,StudentRepository $StudentRepository): Response 
    {
        $user=$UserRapository->findOneBy(['id' => $id]);
        $MediaObjects=$MediaObjectRepository->findBy(['Id_media' => $user]);
        $student=$StudentRepository->findOneBy(['user' => $user]);
        $matieres=$student->getMatieres();
        $classe=$student->getClasse();
        $data = [];


          
             $data[] = [
                 'id'=>$user->getId(),
                 'fullName'=>$user->getFullName(),
                 'username'=>$user->getUsername(),
                 'email'=>$user->getEmail(),
                 'CIN'=> $student->getCin(),
                 'date_naissance'=>$user->getDateNaissance(),
                 'Nationalite'=>$user->getNationalite(),
                 'phone'=>$user->getPhone(),
                 'Classe'=>$classe->getNom(),
               
               
              ];
          foreach ($matieres as $matiere) {
                

           $data[] = [
              'Maietre nom'=>$matiere->getNom(),
                
              
          ];

          }
              foreach ($MediaObjects as $MediaObject) {
                    $photo="http://www.pointofsaleseedigitalaency.xyz/public/media/".$MediaObject->getfilePath();

                $data[] = [
                    'type'=>$MediaObject->getType(),
                    'photo'=> $photo,
                  
                 ];

              }
       
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
    
        return $response;
    }


   /**
     * @Route("/Matiere/{id}", name="getMatiereByStudent")
     * @Method("GET")
     * @Template()
     */
    public function getMatiereByStudent($id,MediaObjectRepository $MediaObjectRepository,UserRepository $UserRapository,MatiereRepository $MatiereRepository,StudentRepository $StudentRepository): Response 
    {
       // $user=$UserRapository->findOneBy(['id' => $id]);
      //  $MediaObjects=$MediaObjectRepository->findBy(['Id_media' => $user]);
        $student=$StudentRepository->findOneBy(['id' => $id]);
        $matieres=$student->getMatieres();
        
        $data = [];

 
         
            foreach ($matieres as $matiere) {
                

            $data[] = [
                 ' nom'=>$matiere->getNom(),
                
           ];

            }
              
       
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
    
        return $response;
    }







     /**
     * @Route("/HomeWork/{id}", name="getHomeWorkByStudent")
     * @Method("GET")
     * @Template()
     */
    public function getHomeWorkByStudent($id,DevoireRepository $DevoireRepository,MediaObjectRepository $MediaObjectRepository,UserRepository $UserRapository,MatiereRepository $MatiereRepository,StudentRepository $StudentRepository): Response 
    {
       // $user=$UserRapository->findOneBy(['id' => $id]);
      //  $MediaObjects=$MediaObjectRepository->findBy(['Id_media' => $user]);
      $student=$StudentRepository->findOneBy(['id' => $id]);
      $matieres=$student->getMatieres();
      $classe=$student->getClasse();
      $home_works=$classe->getDevoires();
      $data = [];


       
          foreach ($home_works as $home_work) {
              
                  if($home_work->getType() ==="home_work"){
          $data[] = [
               'nom'=>$home_work->getName(),
               'date_fin'=>$home_work->getDateFin(),
              
         ];
      }
          }
            
     
      $response = new Response(json_encode($data));
      $response->headers->set('Content-Type', 'application/json');
  
      return $response;
  }

// /**
//  * @Route("/Kids/{id}", name="getUserById")
//  * @Method("GET")
//  * @Template()
//  */
//     public function getKidsById($id,MediaObjectRepository $MediaObjectRepository,KidsRepository $KidsRepository,UserRepository $UserRapository): Response 
//     {
//         $Kids=$KidsRepository->findOneBy(['id' => $id]);
//         $MediaObjects=$MediaObjectRepository->findOneBy(['kids' => $Kids]);

//         $data = [];


//         $photo="http://www.pointofsaleseedigitalaency.xyz/public/media/".$MediaObjects->getfilePath();
//              $data[] = [
//                  'id'=>$Kids->getId(),
//                  'Nom'=>$Kids->getNom(),
//                  'Prenom'=>$Kids->getPrenom(),
//                  'Tag'=>$Kids->getTag(),
//                  'Genre'=>$Kids->getGenre(),
//                  'Ages'=>$Kids->getAges(),
//                  'Langues'=>$Kids->getLangues(),
//                  'Loisirs'=>$Kids->getLoisirs(),
//                  'Duree'=>$Kids->getDuree(),
//                  'photo'=> $photo,
                 
//               ];
//             //   foreach ($MediaObjects as $MediaObject) {
//             //         $photo="http://penfriendseedigital.xyz/media/".$MediaObject->getfilePath();

//             //     $data[] = [
//             //         'type'=>$MediaObject->getType(),
//             //         'photo'=> $photo,
                  
//             //      ];

//             //   }
       
//         $response = new Response(json_encode($data));
//         $response->headers->set('Content-Type', 'application/json');
    
//         return $response;
//     }


//  /**
//  * @Route("/KidsPost/{id}", name="getPostsByKidId")
//  * @Method("GET")
//  * @Template()
//  */
//     public function getPostsByKidId($id,MediaObjectRepository $MediaObjectRepository,KidsRepository $KidsRepository,PostRepository $PostRepository): Response 
//     {
//         $Kids=$KidsRepository->findOneBy(['id' => $id]);
//         $posts=$PostRepository->findBy(['kids' => $Kids]);
//         $MediaObjects=$MediaObjectRepository->findBy(['post_id' => $posts]);

//         $data = [];
//         foreach ($posts as $post) {

   
//              $data[] = [
//                  'id'=>$post->getId(),
//                  'title'=>$post->getTitle(),
//                  'slug'=>$post->getSlug(),
                
//                  'content'=>$post->getContent(),
//                  'publishedAt'=>$post->getPublishedAt(),
                 
                 
//               ];

//             }
//               foreach ($MediaObjects as $MediaObject) {
//                     $photo="http://penfriendseedigital.xyz/media/".$MediaObject->getfilePath();

//                 $data[] = [
      
//                     'photo'=> $photo,
                  
//                  ];

//               }
       
//         $response = new Response(json_encode($data));
//         $response->headers->set('Content-Type', 'application/json');
    
//         return $response;
//     }
// /**
//  * @Route("/KidsTag/{tag}", name="getkidBytag")
//  * @Method("GET")
//  * @Template()
//  */
// public function getKidsBytag($tag,MediaObjectRepository $MediaObjectRepository,KidsRepository $KidsRepository,UserRepository $UserRapository): Response 
// {
//     $Kids=$KidsRepository->findOneBy(['Tag' => $tag]);
//     $MediaObjects=$MediaObjectRepository->findOneBy(['kids' => $Kids]);

//     $data = []; 


//     $photo="http://penfriendseedigital.xyz/media/".$MediaObjects->getfilePath();
//          $data[] = [
//              'id'=>$Kids->getId(),
//              'Nom'=>$Kids->getNom(),
//              'Prenom'=>$Kids->getPrenom(),
//              'Tag'=>$Kids->getTag(),
//              'Genre'=>$Kids->getGenre(),
//              'Ages'=>$Kids->getAges(),
//              'Langues'=>$Kids->getLangues(),
//              'Loisirs'=>$Kids->getLoisirs(),
//              'Duree'=>$Kids->getDuree(),
//              'photo'=> $photo,
             
//           ];
//         //   foreach ($MediaObjects as $MediaObject) {
//         //         $photo="http://penfriendseedigital.xyz/media/".$MediaObject->getfilePath();

//         //     $data[] = [
//         //         'type'=>$MediaObject->getType(),
//         //         'photo'=> $photo,
              
//         //      ];

//         //   }
   
//     $response = new Response(json_encode($data));
//     $response->headers->set('Content-Type', 'application/json');

//     return $response;
// }



}
