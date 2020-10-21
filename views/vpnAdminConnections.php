<?php $this->layout('base', ['activeItem' => 'connections', 'pageTitle' => $this->t('Connections')]); ?>
<?php $this->start('content'); ?>
    <table class="tbl">
        <thead>
            <tr>
                <th><?=$this->t('Profile'); ?></th>
                <th><?=$this->t('#Active Connections'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($vpnConnections as $profileId => $connectionList): ?>
        <tr>
            <td><span title="<?=$this->e($profileId); ?>"><?=$this->e($idNameMapping[$profileId]); ?></span></td>
            <td><?=count($connectionList); ?></td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <details>
        <summary><?=$this->t('Details...'); ?></summary>
    <?php foreach ($vpnConnections as $profileId => $connectionList): ?>
        <h2 id="<?=$this->e($profileId); ?>"><?=$this->e($idNameMapping[$profileId]); ?></h2>
        <?php if (0 === count($connectionList)): ?>
            <p class="plain"><?=$this->t('No clients connected.'); ?></p>
        <?php else: ?>
            <table class="tbl">
            <thead>
                <tr>
                    <th><?=$this->t('User ID'); ?></th>
                    <th><?=$this->t('Name'); ?></th>
                    <th><?=$this->t('IP Address'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($connectionList as $connection): ?>
                <tr>
                    <td>
                        <a href="<?=$this->e($requestRoot); ?>user?user_id=<?=$this->e($connection['user_id'], 'rawurlencode'); ?>" title="<?=$this->e($connection['user_id']); ?>"><?=$this->etr($connection['user_id'], 25); ?></a>
                    </td>
                    <td>
                        <span title="<?=$this->e($connection['display_name']); ?>"><?=$this->etr($connection['display_name'], 25); ?></span>
                    </td>
                    <td>
                        <ul>
                            <?php foreach ($connection['virtual_address'] as $ip): ?>
                            <li><code><?=$this->e($ip); ?></code></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>
    </details>
<?php if (!(false === $wgUserConnections)): ?>
    <details>
        <summary><?= count($wgUserConnections).$this->t(' WireGuard Connections...'); /* todo: number in translation */ ?></summary>
        <?php if (0 === count($wgUserConnections)): ?>
            <p class="plain"><?= $this->t('No clients connected.'); ?></p>
        <?php else: ?>
            <table class="tbl">
                <thead>
                <tr>
                    <th><?= $this->t('User ID'); ?></th>
                    <th><?= $this->t('Name'); ?></th>
                    <th><?= $this->t('Allowed IP Addresses'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($wgUserConnections as $userID => $wgConnections): ?>
                    <?php foreach ($wgConnections as $wgConnection): ?>
                        <tr>
                            <td>
                                <a href="<?= $this->e($requestRoot); ?>user?user_id=<?= $this->e($userID, 'rawurlencode'); ?>"
                                   title="<?= $this->e($userID); ?>"><?= $this->etr($userID, 25); ?></a>
                            </td>
                            <td>
                                <span title="<?= $this->e($wgConnection->name); ?>"><?= $this->etr($wgConnection->name, 25); ?></span>
                            </td>
                            <td>
                                <ul>
                                    <?php foreach ($wgConnection->allowedIPs as $ip): ?>
                                        <li><code><?= $this->e($ip); ?></code></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </details>
<?php endif; ?>
<?php $this->stop('content'); ?>
