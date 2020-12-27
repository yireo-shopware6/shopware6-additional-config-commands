<?php declare(strict_types=1);

namespace Yireo\AdditionalConfigCommands\Console\Command;

use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigList extends Command
{
    protected static $defaultName = 'system:config:list';

    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        parent::__construct();
        $this->systemConfigService = $systemConfigService;
    }

    protected function configure(): void
    {
        $this
            ->addOption('salesChannelId', 's', InputOption::VALUE_OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $values = $this->systemConfigService->all($input->getOption('salesChannelId'));
        $table = new Table($output);
        $table->setHeaders(['Key', 'Value']);

        foreach ($values as $name => $value) {
            $this->addTableRow($table, $name, $value);
        }

        $table->render();

        return 0;
    }

    private function addTableRow(Table $table, string $name, $value): void
    {
        if (is_array($value)) {
            foreach ($value as $subName => $subValue) {
                $this->addTableRow($table, $name.'.'.$subName, $subValue);
            }

            return;
        }

        $table->addRow([$name, (string)$value]);
    }
}
