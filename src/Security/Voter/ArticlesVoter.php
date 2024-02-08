<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
// use Symfony\Component\Security\Core\Security;
use App\Entity\Articles;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Symfony\Bundle\SecurityBundle\Security;

class ArticlesVoter extends Voter
{
    const EDIT = 'ARTICLE_EDIT';
    const DELETE = 'ARTICLE_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    protected function supports(string $attribute, mixed $subject): bool
    {
        // if(!in_array($attribute, [self::EDIT, self::DELETE])) return false;

        // if(!$article instanceof Articles) return false;

        // return true;
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::DELETE, self::EDIT])) {
            return false;
        }

        // only vote on `Post` objects
        if (!$subject instanceof APP\Entity\Article) {
            return false;
        }

        return true;
    }
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        // On recupere l'utilisateur à partir du token
        $user = $token->getUser();

        $article = $subject;

        if(!$user instanceof UserInterface) return false;

        // verifier si l'utilisateur est admin

        if($this->security->isGranted('ROLE_BLOG_ADMIN')) return true;

        //on verifie les permissions

        switch($attribute){
            case self::EDIT:
                //on verifie si l'utilisateur peut editer
                return $this->canEdit();
                break;
            case self::DELETE:
                //on verifie si l'utilisateur peut supprimer
                return $this->canDelete();
                break;
        }
    }

    private function canEdit(){
        return $this->security->isGranted('ROLE_BLOG_ADMIN');
    }
    private function canDelete(){
        return $this->security->isGranted('ROLE_BLOG_ADMIN');
    }
}