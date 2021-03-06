<?php

namespace Railken\Mangadex\Concerns;

trait MangadexTags
{
    protected $availableContentTags = [
        9  => 'Ecchi',
        49 => 'Gore',
        50 => 'Sexual Violence',
        32 => 'Smut',
    ];

    protected $availableFormatTags = [
        1  => '4-Koma',
        42 => 'Adaptation',
        43 => 'Anthology',
        4  => 'Award Winning',
        7  => 'Doujinshi',
        48 => 'Fan Colored',
        45 => 'Full Color',
        36 => 'Long Strip',
        47 => 'Official Colored',
        21 => 'Oneshot',
        46 => 'User Created',
        44 => 'Web Comic',
    ];

    protected $availableGenreTags = [
        2  => 'Action',
        3  => 'Adventure',
        5  => 'Comedy',
        51 => 'Crime',
        8  => 'Drama',
        10 => 'Fantasy',
        13 => 'Historical',
        14 => 'Horror',
        41 => 'Isekai',
        52 => 'Magical Girls',
        17 => 'Mecha',
        18 => 'Medical',
        20 => 'Mystery',
        53 => 'Philosophical',
        22 => 'Psychological',
        23 => 'Romance',
        25 => 'Sci-Fi',
        28 => 'Shoujo Ai',
        30 => 'Shounen Ai',
        31 => 'Slice of Life',
        33 => 'Sports',
        54 => 'Superhero',
        55 => 'Thriller',
        35 => 'Tragedy',
        56 => 'Wuxia',
        37 => 'Yaoi',
        38 => 'Yuri',
    ];

    protected $availableThemeTags = [
        57 => 'Aliens',
        58 => 'Animals',
        6  => 'Cooking',
        59 => 'Crossdressing',
        61 => 'Delinquents',
        60 => 'Demons',
        62 => 'Genderswap',
        63 => 'Ghosts',
        11 => 'Gyaru',
        12 => 'Harem',
        83 => 'Incest',
        65 => 'Loli',
        66 => 'Magic',
        16 => 'Martial Arts',
        67 => 'Military',
        64 => 'Monster Girls',
        68 => 'Monsters',
        19 => 'Music',
        69 => 'Ninja',
        70 => 'Office Workers',
        71 => 'Police',
        72 => 'Post-Apocalyptic',
        73 => 'Reincarnation',
        74 => 'Reverse Harem',
        75 => 'Samurai',
        24 => 'School Life',
        76 => 'Shota',
        34 => 'Supernatural',
        77 => 'Survival',
        78 => 'Time Travel',
        80 => 'Traditional Games',
        79 => 'Vampires',
        40 => 'Video Games',
        81 => 'Virtual Reality',
        82 => 'Zombies',
    ];

    public function getAvailableTags()
    {
        return array_merge(
            $this->getAvailableThemeTags(),
            $this->getAvailableGenreTags(),
            $this->getAvailableContentTags(),
            $this->getAvailableFormatTags()
        );
    }

    public function getAvailableThemeTags()
    {
        return $this->availableThemeTags;
    }

    public function getAvailableGenreTags()
    {
        return $this->availableGenreTags;
    }

    public function getAvailableFormatTags()
    {
        return $this->availableFormatTags;
    }

    public function getAvailableContentTags()
    {
        return $this->availableContentTags;
    }
}
