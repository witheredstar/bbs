<?php
/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flarum\Api;

use Flarum\Database\AbstractModel;
use DateTime;

/**
 * @property string $id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $expires_at
 * @property \Flarum\Core\User|null $user
 */
class AccessToken extends AbstractModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'access_tokens';

    /**
     * Use a custom primary key for this model.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * {@inheritdoc}
     */
    protected $dates = ['created_at', 'expires_at'];

    /**
     * Generate an access token for the specified user.
     *
     * @param int $userId
     * @param int $minutes
     * @return static
     */
    public static function generate($userId, $minutes = 60)
    {
        $token = new static;

        $token->id = str_random(40);
        $token->user_id = $userId;
        $token->created_at = time();
        $token->expires_at = time() + $minutes * 60;

        return $token;
    }

    /**
     * Check that the token has not expired.
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->expires_at > new DateTime;
    }

    /**
     * Define the relationship with the owner of this access token.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Flarum\Core\User');
    }
}
