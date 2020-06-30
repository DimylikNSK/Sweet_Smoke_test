<?php


class UrlRebuilder
{
    private $scheme;
    private $host;
    private $path;
    private $query;

    public function __construct(string $url)
    {
        $url_array = parse_url($url);
        $this->scheme = $url_array['scheme'];
        $this->host = $url_array['host'];
        $this->path = $url_array['path'];
        $this->query = $url_array['query'];

        $this->queryToArray();

        return $this;
    }

    private function queryToArray()
    {
        $result = [];
        $tmp_array = explode('&', $this->query);
        foreach ($tmp_array as $key => $value)
        {
            $arr = explode('=', $value);
            $result[$arr[0]] = $arr[1];
        }

        $this->query = $result;
    }


    public function sortQueryArray()
    {
        asort($this->query);

        return $this;
    }

    public function removeValues($value)
    {
        foreach ($this->query as $key => $item)
        {
            if ($item == $value)
            {
                unset($this->query[$key]);
            }
        }

        return $this;
    }

    public function rebuild()
    {
        $this->query['url'] = $this->path;
        $url = $this->scheme . '://' . $this->host . '/?' ;
        $newUrl = $url . http_build_query($this->query);
        return $newUrl;
    }
}