<?php

declare(strict_types=1);

namespace App\Command;

use App\Classes\Request\Osmosis\OsmosisAssetPriceRequest;
use App\Classes\Request\Osmosis\OsmosisAssetsRequest;
use App\Document\OsmosisAsset;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:asset:populate-osmosis-assets',
    description: 'Fetch osmosis assets and save them in the database.'
)]
class PopulateOsmosisAssetsCommand extends Command
{
    public function __construct(
        private readonly DocumentManager $documentManager,
        private readonly OsmosisAssetsRequest $assetsRequest,
        private readonly OsmosisAssetPriceRequest $assetPriceRequest,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'apply-changes',
            null,
            InputOption::VALUE_NONE
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Fetching osmosis assets.');
        $applyChanges = (bool) $input->getOption('apply-changes');

        $assets = $this->assetsRequest->executeRequest();
        $repository = $this->documentManager->getRepository(OsmosisAsset::class);

//        dump($this->assetPriceRequest->executeRequest(['OSMO']));

        foreach ($assets->getAssets() as $assetResponse) {
            $name = $assetResponse->getName();
            $exists = (bool) $repository->findOneBy(['name' => $name]);

            if ($exists) {
                $output->writeln(sprintf('%s already exists.', $name));

                continue;
            }

            $output->writeln(sprintf('Saving %s.', $name));
            $osmosisAsset = OsmosisAsset::createFromResponse($assetResponse);

            $this->documentManager->persist($osmosisAsset);
        }

        if ($applyChanges) {
            $this->documentManager->flush();
        }

        return Command::SUCCESS;
    }
}
