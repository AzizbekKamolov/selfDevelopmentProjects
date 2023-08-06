<?php
namespace SelfDevelopmentProjects;

class User
{
    public int $age;
    public int $favourite_movies;
    public string $name;

    /**
     * @param int $age
     * @param string $name
     */
    public function __construct(int $age, string $name)
    {
        $this->age = $age;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function tellName(): string {
        return 'I\'am ' . $this->name;
    }

    /**
     * @return string
     */
    public function tellAge(): int {
        return 'I\'am ' . $this->age;
    }

    /**
     * @param string $movie
     * @return bool
     */
    public function addFvouriteMovies(string $movie): bool {
        $this->favourite_movies[] = $movie;

        return true;
    }

    public function removeFavouriteMovie($movie): bool {
        if (!in_array($movie, $this->favourite_movies)) throw new InvalidArgumentException('Unknown movie ' . $movie);

        unset($this->favourite_movies[array_search($movie, $this->favourite_movies)]);
        return true;
    }
}