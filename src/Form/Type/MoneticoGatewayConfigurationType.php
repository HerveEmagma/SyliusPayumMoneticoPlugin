<?php

namespace Prometee\SyliusPayumMoneticoPlugin\Form\Type;

use Ekyna\Component\Payum\Monetico\Api\Api;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class MoneticoGatewayConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mode', ChoiceType::class, [
                'expanded' => true,
                'label' => 'prometee.monetico.fields.mode.label',
                'choices' => [
                    'prometee.monetico.mode.production' => Api::MODE_PRODUCTION,
                    'prometee.monetico.mode.test' => Api::MODE_TEST
                ],
            ])
            ->add('tpe', TextType::class, [
                'label' => 'prometee.monetico.fields.tpe.label',
                'help' => 'prometee.monetico.fields.tpe.help',
                'constraints' => [
                    new NotBlank([
                        'message' => 'prometee.monetico.tpe.not_blank',
                        'groups' => ['sylius']
                    ]),
                    new Length([
                        'groups' => ['sylius'],
                        'min' => 7,
                        'max' => 7
                    ]),
                ],
            ])
            ->add('key', TextType::class, [
                'label' => 'prometee.monetico.fields.key.label',
                'constraints' => [
                    new NotBlank([
                        'message' => 'prometee.monetico.key.not_blank',
                        'groups' => ['sylius']
                    ]),
                    new Length([
                        'groups' => ['sylius'],
                        'max' => 40
                    ])
                ],
            ])
            ->add('company', TextType::class, [
                'label' => 'prometee.monetico.fields.company.label',
                'help' => 'prometee.monetico.fields.company.help',
                'constraints' => [
                    new NotBlank([
                        'message' => 'prometee.monetico.company.not_blank',
                        'groups' => ['sylius']
                    ]),
                    new Length([
                        'groups' => ['sylius'],
                        'max' => 20
                    ])
                ],
            ])
            /*->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $data['payum.http_client'] = '@prometee.monetico.bridge.monetico_bridge';
                $event->setData($data);
            })*/
        ;
    }
}
